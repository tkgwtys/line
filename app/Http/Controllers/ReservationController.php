<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request)
    {
        Log::debug($request);
        // 予約者
        $user_id = $request->get('user');
        // トレーナ
        $player_id = $request->get('player');
        // 予約日
        $reserved_at = Carbon::parse($request->get('selected_date') . ' ' . $request->get('selected_time') . ':00');
        $status = 10;
        $category = 10;
        // 保存
        $reservation = new Reservation();
        $reservation->fill([
            'user_id' => $user_id,
            'player_id' => $player_id,
            'status' => $status,
            'category' => $category,
            'reserved_at' => $reserved_at,
        ]);
        $result = $reservation->save();
        return ['result' => $result];
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
