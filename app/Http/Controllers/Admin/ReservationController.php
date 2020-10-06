<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Course;
use App\Models\Player;
use App\Models\Reservation;
use App\Models\ReservationMemo;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use Exception;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * 新規登録
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $now
     * @param $reservation
     * @return array
     */
    public function store(Request $request)
    {
        $data = [
            'status' => false,
            'message' => '',
        ];
        $reservationDates = [];
        // 10は仮予約
        $status = 30;
        // カテゴリー
        $category_id = 10;
        // トレーナ
        $player_id = $request->get('player');
        // コース
        $course_id = (int)$request->get('course');
        // 店舗
        $store_id = (int)$request->get('store');
        // 予約ID
        $reservation_id = $request->get('reservation_id');
        // 予約指定日
        $selected_date = $request->get('selected_date');
        // 予約日
        $selected_time = $request->get('selected_time');
        // 予約した人
        $user_id = $request->get('user');
        // 備考
        $reservation_memo = $request->get('reservation_memo');

        //////////////////
        /// トレーナがいるか
        $player = User::where('id', $player_id)->where('level', 20)->whereNull('blocked_at')->first();
        if (!$player) {
            return $data['message'] = 'トレーナが見つかりません';
        }
        //////////////////
        /// ストア
        $store = Store::where('id', $store_id)->first();
        if (!$store) {
            return $data['message'] = '店舗が見つかりません';
        }
        //////////////////
        $now = Carbon::today()->format('Y-m-d H:m:i');
        /// アップデート
        if ($reservation_id) {
            $reservation = Carbon::parse($selected_date . ' ' . $selected_time);
            DB::beginTransaction();
            Reservation::where('reservation_id', $reservation_id)->update([
                'status' => $status,
                'category'=> $category_id,
                'player_id' => $player_id,
                'course_id' => $course_id,
                'store_id' => $store_id,
                'user_id' => $user_id,
                'updated_at' => $now,
                'reserved_at' => $reservation,
                ]);
            DB::commit();
        } else {
            /////////////////
            /// 予約データー作成（45分）
            $reservationDates[0] = Carbon::parse($selected_date . ' ' . $selected_time);
            $reservationDates[1] = Carbon::parse($reservationDates[0])->addMinutes(15);
            $reservationDates[2] = Carbon::parse($reservationDates[1])->addMinutes(15);
            $reservationDates[3] = Carbon::parse($reservationDates[2])->addMinutes(15);
            if (count($reservationDates)) {
                // 予約データーがかぶってないか
                foreach ($reservationDates as $key => $reservation) {
                    $result = Reservation::where('reserved_at', $reservation)
                        ->where('category', $category_id)
                        ->where('player_id', $player_id)
                        ->where('status', $status)
                        ->whereNull('deleted_at')
                        ->first();
                    if ($result) {
                        return $data = [
                            'status' => false,
                            'message' => '「' . $reservation . '」はすでに予約中です',
                        ];
                    }
                }

                // トランザクション
                $reservation_id = Str::random(10);
                DB::beginTransaction();
                foreach ($reservationDates as $key => $reservation) {
                    $insert_data = [
                        'reservation_id' => $reservation_id,
                        'user_id' => $user_id,
                        'player_id' => $player_id,
                        'status' => $status,
                        'category' => $category_id,
                        'course_id' => $course_id,
                        'store_id' => $store_id,
                        'reserved_at' => $reservation,
                        'created_at' => $now,
                        'updated_at' => $now,
                        'reservation_sort' => ++$key,
                    ];
                    Reservation::insert($insert_data);
                }
                $memoData = [
                    'reservation_id' => $reservation_id,
                    'reservation_memo' => $reservation_memo,
                ];
                Log::debug($memoData);
                ReservationMemo::insert($memoData);

                DB::commit();
            }
        }
        $user_message = "予約が確定しました。\n\n";
        $user_message .= 'トレーナ：' . $player->sei . $player->mei . "\n";
        $user_message .= '日時：' . Carbon::parse($selected_date . ' ' . $selected_time)->format('Y年m月d日 H時i分') . "\n";
        $user_message .= '店舗：' . $store->name . "\n";
        $user_messageBuilder = new TextMessageBuilder($user_message);
        $bot = app('line-bot');
        $bot->pushMessage($user_id, $user_messageBuilder);
        return $data = [
            'status' => true,
            'message' => '予約を確定しました',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $player_id)
    {
        if (!Auth::check()) {
            return \redirect('login');
        }
        // トレーナ取得
        $player = User::where(['id' => $player_id, 'level' => 20])->first();
        if (!$player) {
            print_r('トレーナが見つかりません');
            exit;
        }
        // 表示件数
        $max_day = !empty($request->get('day_count')) ? $request->get('day_count') : 14;
        // スタート日付
        $start_date = !empty($request->get('start_date')) ? $request->get('start_date') : Carbon::now()->toDateString();
        // つぎの週
        $back_date = Carbon::parse($start_date)->addDays(-$max_day)->format('Y-m-d');
        $next_date = Carbon::parse($start_date)->addDays($max_day)->format('Y-m-d');
        // 15分刻みの時間を取得する
        $time_array = Reservation::getOpenTimeArray();
        // 店舗
        $stores = Store::all();
        // コース
        $courses = Course::all();
        // 本日から２週間表示
        for ($i = 0; $i < $max_day; $i++) {
            //日付と曜日の取得
            $days_array[$i] = Carbon::parse($start_date)->addDay($i)->format('Y-m-d');
            $days_array_format[$i][0] = Carbon::parse($start_date)->addDay($i)->isoFormat('ddd');
            $days_array_format[$i][1] = Carbon::parse($start_date)->addDay($i)->isoFormat('D');
            $days_array_format[$i][2] = Carbon::parse($start_date)->addDay($i)->dayOfWeekIso;
        }
        ///////////////////
        /// 予約データー取得
        $reservation_model = new Reservation();
        $reservations = $reservation_model->getReservation($start_date . ' 00:00:00', Carbon::parse($start_date)->addDay($max_day)->toDateString() . ' 23:59:59');
        ///////////////////
        /// view取得
        return view('reservation.show', compact(
            'max_day',
            'player_id',
            'time_array',
            'days_array',
            'days_array_format',
            'stores',
            'courses',
            'player',
            'reservations',
            'next_date',
            'back_date'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        //
        Log::debug($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 予約キャンセル
     * @param $reservation_id
     * @return array|string
     */
    public function destroy($reservation_id)
    {
        $data = [
            'result' => false,
            'message' => 'キャンセル失敗',
        ];
        $reservation = Reservation::findByReservationId($reservation_id);
        if (!$reservation) {
            return $data['message'] = '予約がみつかりません';
        }
        $result = Reservation::where('reservation_id', $reservation_id)->whereNull('deleted_at')->delete();
        if ($result) {
            // お客様にプッシュ通知
            $bot = app('line-bot');
            ////////////////////////////////////
            /// ユーザー
            ////////////////////////////////////
            $user_message = "キャンセルしました。\n\n";
            $user_message .= '日時：' . $reservation->reservations_reserved_at . "\n";
            $user_message .= 'トレーナ：' . $reservation->player_sei . $reservation->player_mei . "\n";
            $user_message .= '店舗：' . $reservation->stores_name . "\n";
            $user_messageBuilder = new TextMessageBuilder($user_message);
            $bot->pushMessage($reservation->reservations_user_id, $user_messageBuilder);
            ////////////////////////////////////
            /// プレイヤー
            ////////////////////////////////////
            $player_message = "予約がキャンセルされました。\n\n";
            $player_message .= '名前：' . $reservation->user_sei . $reservation->user_mei . "様\n";
            $player_message .= '日時：' . $reservation->reservations_reserved_at . "\n";
            $player_message .= '店舗：' . $reservation->stores_name . "\n";
            $player_messageBuilder = new TextMessageBuilder($player_message);
            $bot->pushMessage($reservation->reservations_player_id, $player_messageBuilder);
            // 結果
            $data['result'] = true;
            $data['message'] = 'キャンセルしました';
        }
        return $data;
    }

    /**
     * 予約完了
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function end(Request $request)
    {
        $player_id = $request->input('player_id');
        return view('reservation.end')->with('player_id', $player_id);
    }
}
