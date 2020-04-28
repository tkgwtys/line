<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\Player;
use App\Models\PlayerImage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Image;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $players = Player::all();
        if ($players) {
            foreach ($players as $key => $play) {
                $players[$key]->images = PlayerImage::where('player_id', $play->id)->first();
            }
        }
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
        DB::transaction(function () use ($request) {
            // ファイル名ランダム作成
            $file_name = Str::random(32) . '.jpg';
            // POSTデーター取得
            $player = Player::create($request->all());
            // 画像を保存している
            $request->file('image')->storeAs('public/images/players/' . $player->id, $file_name);
            // POSTのデーターをデーターベースに保存している
            PlayerImage::create([
                'player_id' => $player->id,
                'file_name' => $file_name,
            ])->save();
        });
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
        $player = Player::find($player_id);
        $player_image = PlayerImage::find($player_id);
        return view('admin.player.show')
            ->with([
                'player_id' => $player_id,
                'player' => $player,
                'player_image' => $player_image,
            ]);
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
