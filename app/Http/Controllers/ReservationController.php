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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
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
        $tick = 15;
        // ステータス
        $status = 10;
        // カテゴリー
        $category = 10;
        //
        $insert_array = [];
        DB::beginTransaction();
        // 時間
        $now = Carbon::now();
        try {
            // 予約番号
            $reservation_id = Str::random(20);
            // 予約者
            $user_id = $request->get('user');
            // トレーナ
            $player_id = $request->get('player');
            // コース
            $course_id = (int)$request->get('course');
            // 店舗
            $store_id = (int)$request->get('store');
            // 予約日
            $reserved_at = Carbon::parse($request->get('selected_date') . ' ' . $request->get('selected_time'));
            // コースが存在するか
            $course = Course::find($course_id)->first();
            if (!$course) {
                Log::debug('コースがない');
            }
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
            DB::commit();
            return ['result' => $result];
        } catch (\Exception $e) {
            DB::rollBack();
            print_r($e);
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
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     */
    public function destroy($id)
    {
        $result = Reservation::where('reservation_id', $id)->whereNull('deleted_at')->delete();
        Log::debug($result);
        return ['result' => $result];
    }
}
