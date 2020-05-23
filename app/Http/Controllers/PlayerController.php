<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Player;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index()
    {
        $players = Player::all();
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
        $time_array = [];
        for ($i = 7; $i <= 23; $i++) {
            for ($j = 0; $j <= 55; $j += 15) {
                $time_array[$i][$j] = sprintf("%02d:%02d\n", $i, $j);
            }
        }
        $player_array = Player::all();
        $player = Player::find($player_id);
        return view('admin.player.show',
            compact('player', 'time_array', 'player_array')
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
        $player = Player::find($id);
        return view('admin.player.edit', ['player' => $player]);
    }


    /**　
     * @param UpdateUserRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $player = Player::find($id);

        if ($request->image) {
            $request->file('image')->storeAs('public/images/players/' . $player->id, 'original.jpg');
            Image::make($request->file('image'))->resize(300, 300)->save('storage/images/players/' . $player->id . '/300x300.jpg');
            Image::make($request->file('image'))->resize(500, 500)->save('storage/images/players/' . $player->id . '/500x500.jpg');
        }
        $player->sei = $request->sei;
        $player->mei = $request->mei;
        $player->sei_hira = $request->sei_hira;
        $player->mei_hira = $request->mei_hira;
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
