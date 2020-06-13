<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Models\Course;
use App\Models\Reservation;
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
        try {
            Log::debug($request);
            // 予約番号
            $reservation_id = Str::random(20);
            // 予約者
            $user_id = $request->get('user');
            // トレーナ
            $player_id = $request->get('player');
            // コース
            $course_id = (int)$request->get('course');
            // 予約日
            $future_time_string = $request->get('selected_date') . ' ' . $request->get('selected_time');
            $reserved_at = Carbon::parse($request->get('selected_date') . ' ' . $request->get('selected_time'));
            // コースが存在するか
            $course = Course::find($course_id)->first();
            if (!$course) {
                Log::debug('コースがない');
            }
            // マックス時間
            $future_time = Carbon::parse($reserved_at)->addMinutes($course->course_time)->format('Y-m-d h:i:s');
            // １５分刻みに作成
            for ($i = 0; $i < 10; $i++) {
                $insert_array[] = $reserved_at->addMinutes($tick)->format('Y-m-d h:i:s');
                if (last($insert_array) == $future_time) {
                    array_pop($insert_array);
                    break;
                }
            }
            array_unshift($insert_array, $future_time_string);
            $insert_date_times = [];
            foreach ($insert_array as $key => $val) {
                $insert_date_times[] = [
                    'reservation_id' => $reservation_id,
                    'user_id' => $user_id,
                    'player_id' => $player_id,
                    'status' => $status,
                    'category' => $category,
                    'course_id' => $course_id,
                    'reserved_at' => $val];
            }
            $result = Reservation::insert($insert_date_times);
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
     * @return void
     */
    public function show($id)
    {
        //
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
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
