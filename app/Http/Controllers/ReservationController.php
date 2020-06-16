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
