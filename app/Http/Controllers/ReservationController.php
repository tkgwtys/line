<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Course;
use App\Models\Reservation;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        $reservations = Reservation::getUserReservations(Auth::id());
        return view('reservation.index', compact('reservations')
        );
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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array
     */
    public function store(CreateReservationRequest $request)
    {
        $data = [
            'result' => true,
            'message' => '',
        ];
        // カテゴリー
        $category = 10;
        // 予約者
        $user_id = $request->get('user');
        // トレーナ
        $player_id = $request->get('player');
        // コース
        $course_id = (int)$request->get('course');
        // 店舗
        $store_id = (int)$request->get('store');
        // 予約番号
        $reservation_id = $request->get('reservation_id');
        // ステータス
        $status = $request->get('status');
        // タイプ（userかadminか）
        $type = $request->get('type');
        DB::beginTransaction();
        try {
            // 時間
            $now = Carbon::today()->format('Y-m-d H:m:i');
            // 予約日
            $reserved_at = $request->get('selected_date') . ' ' . $request->get('selected_time');
            // コースが存在するか
            $course = Course::find($course_id)->first();
            if (!$course) {
                Log::debug('コースがない');
            }
            // 予約者
            $user = User::where('id', $user_id)->first();
            // トレーナー
            $player = User::where('id', $player_id)->where('level', 20)->first();
            // 店舗
            $store = Store::where('id', $store_id)->first();
            // 予約があるか
            if ($reservation_id) {
                // 更新
                $update_date = [
                    'user_id' => $user_id,
                    'status' => $status,
                    'category' => $category,
                    'course_id' => $course_id,
                    'store_id' => $store_id,
                    'reserved_at' => $reserved_at,
                    'updated_at' => $now,
                ];
                $result = Reservation::where('reservation_id', $reservation_id)->update($update_date);
            } else {
                // 予約番号
                $reservation_id = Str::random(20);
                $insert_data = [
                    'reservation_id' => $reservation_id,
                    'user_id' => $user_id,
                    'player_id' => $player_id,
                    'status' => $status,
                    'category' => $category,
                    'course_id' => $course_id,
                    'store_id' => $store_id,
                    'reserved_at' => $reserved_at,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $result = Reservation::insert($insert_data);
            }
            DB::commit();
            $bot = app('line-bot');
            if ($status == 10) {
                ////////////////////////////
                // トレーナー
                $player_message = "予約申請\n";
                $player_message .= $user->sei . $user->mei . "様\n";
                $player_message .= Carbon::parse($reserved_at)->format('Y年m月d日 H:i') . "\n";
                $player_message .= config('app.url') . 'admin';
                $textMessageBuilder = new TextMessageBuilder($player_message);
                $bot->pushMessage($player_id, $textMessageBuilder);

                ////////////////////////////
                // 自分
                $user_message = "予約申請しました\n\n";
                $user_message .= '日時：' . Carbon::parse($reserved_at)->format('Y年m月d日 H:i') . "\n";
                $user_message .= 'トレーナー：' . $player->sei . $player->mei . "\n";
                $user_message .= '店舗：' . $store->name . "\n";
                $user_message .= 'ステータス：' . Reservation::getStatus($status);
                $textMessageBuilder = new TextMessageBuilder($user_message);
                $bot->pushMessage($user_id, $textMessageBuilder);

                $data['result'] = true;
                $data['message'] = '予約申請しました';
            } else if ($status == 20) {
                $message = "予約が確定しました\n" . Carbon::parse($reserved_at)->format('Y年m月d日 H:i');
                $textMessageBuilder = new TextMessageBuilder($message);
                $bot->pushMessage($user_id, $textMessageBuilder);
                $data['result'] = true;
                $data['message'] = '予約がキャンセルされました';
            } else if ($status == 30) {

            }
            return $data;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $player_id)
    {
        try {
            // 予約者
            $user_id = $request->get('uid');
            $type = $request->get('type') ? $request->get('type') : 'p';
            $user = User::where('id', $user_id)->first();
            if (!$user) {
                throw new Exception("ユーザーがみつかりません");
            }
            // 明日
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');
            // 時間
            $time_array = Reservation::getOpenTimeArray();
            // トレーナ全員
            $player = User::where('id', $player_id)->where('level', 20)->first();
            if ($player) {
                $image = asset('storage/images/users/' . $player['id'] . '/300x300.jpg');
                $player['image'] = $image;
            }
            // トレーナ全員
            $player_array = User::where('level', 20)->get();
            // コース
            $courses = Course::all();
            // 店舗一覧
            $stores = Store::all();
            return view('reservation.show', compact(
                    'player',
                    'player_id',
                    'time_array',
                    'type',
                    'courses',
                    'stores',
                    'tomorrow',
                    'user',
                    'player_array',
                    'user_id')
            );
        } catch (\Exception $e) {
            print_r($e);
        }
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
        // ユーザーがいるか
        $user = User::where('id', Auth::id())->whereNull('blocked_at')->first();
        if (!$user) {
            return $data;
        }
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
            return $data;
        }
    }
}
