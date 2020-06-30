<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Reservation;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class PlayerController extends Controller
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
     * @return void
     */
    public function store(Request $request)
    {
        //
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
            return view('player.show', compact(
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
            print_r($e->getMessage());
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
