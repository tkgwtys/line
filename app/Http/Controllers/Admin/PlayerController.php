<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $players = User::where('level', 20)->get();
        return view('admin.player.index')
            ->with('players', $players);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateUserRequest $request)
    {
        $path = public_path('storage/images/players');
        if (!(new Filesystem)->isDirectory($path)) {
            (new Filesystem)->makeDirectory($path, 0777, true);
        }


        // ファイル名ランダム作成
        $file_name = 'original.jpg';
        // POSTデーター取得
        $player = Player::create($request->all());
        // 画像を保存している
        $request->file('image')->storeAs('public/images/players/' . $player->id, $file_name);
        Image::make($request->file('image'))->resize(300, 300)->save('storage/images/players/' . $player->id . '/300x300.jpg');
        Image::make($request->file('image'))->resize(500, 500)->save('storage/images/players/' . $player->id . '/500x500.jpg');
        return redirect('/admin/player'); //->with('success', '新しいトレーナをを登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param int $player_id
     * @return void
     */
    public function show($player_id)
    {
        // 時間
        $time_array = [];
        for ($i = 7; $i <= 23; $i++) {
            for ($j = 0; $j <= 55; $j += 15) {
                $time_array[$i][$j] = sprintf("%02d:%02d", $i, $j);
            }
        }
        // トレーナ全員
        $player_array = User::where('level', 20)->get();
        // 日付
        $days_array = [];
        for ($i = 0; $i <= 6; $i++) {
            $days_array[] = Carbon::today()->addDay($i)->format('Y-m-d');
        }
        // プレイヤー１件
        $player = User::find($player_id);
        return view('admin.player.show',
            compact('player', 'time_array', 'player_array', 'days_array', 'user_level')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $user_level = [
            10 => '一般',
            20 => 'トレーナー',
        ];
        $player = User::find($id);
        return view('admin.player.edit', ['player' => $player, 'user_level' => $user_level]);
    }


    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $player = User::find($id);
        if (!$player) {
            return redirect('/admin/player');
        }
        if ($request->image) {
            $request->file('image')->storeAs('public/images/players/' . $player->id, 'original.jpg');
            Image::make($request->file('image'))->resize(300, 300)->save('storage/images/players/' . $player->id . '/300x300.jpg');
            Image::make($request->file('image'))->resize(500, 500)->save('storage/images/players/' . $player->id . '/500x500.jpg');
        }
        $player->sei = $request->sei;
        $player->mei = $request->mei;
        $player->sei_hira = $request->sei_hira;
        $player->mei_hira = $request->mei_hira;
        $player->level = $request->level;
        $player->self_introduction = $request->self_introduction;
        $player->save();
        return redirect('/admin/player');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $player_id = Player::find($id);
        $player_id->delete();
        return redirect('/admin/player');
    }
}
