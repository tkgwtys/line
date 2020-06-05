<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function show(Request $request, $id)
    {
        try {
            // 予約者
            $user_id = $request->get('uid');
            $user = User::where('id', $user_id)->first();
            if (!$user) {
                throw new Exception("ユーザーがみつかりません");
            }
            // 明日
            $tomorrow = Carbon::tomorrow()->format('Y-m-d');
            // 時間
            $time_array = [];
            for ($i = 7; $i <= 23; $i++) {
                for ($j = 0; $j <= 55; $j += 15) {
                    $time_array[$i][$j] = sprintf("%02d:%02d", $i, $j);
                }
            }
            $player = User::where('id', $id)->where('level', 20)->first();
            if ($player) {
                $image = asset('storage/images/players/' . $player['id'] . '/300x300.jpg');
                $player['image'] = $image;
            }
            return view('player.show', compact('player', 'time_array', 'tomorrow', 'user', 'user_id'));
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
