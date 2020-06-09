<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // フレンド取得
        $users = User::all();
        return view('admin.user.index')
            ->with('users', $users);
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
     * @return Factory|View
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function edit($id)
    {
        $user_level = [
            10 => '一般',
            20 => 'トレーナー',
        ];
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user, 'user_level' => $user_level]);

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
        $user_level = [
            10 => '一般',
            20 => 'トレーナー',
        ];

        //UserをDBで見つける
        $user = User::find($id);
        //データ代入
        $user->sei = $request->sei;
        $user->mei = $request->mei;
        $user->sei_hira = $request->sei_hira;
        $user->mei_hira = $request->mei_hira;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->self_introduction = $request->self_introduction;
        //DBへ保存
        $user->save();

        //画像保存先作成
        $path = public_path('storage/images/users');
        if (!(new Filesystem)->isDirectory($path)) {
            (new Filesystem)->makeDirectory($path, 0777, true);
        }

        if ($request->image) {
            $request->file('image')->storeAs('public/images/users/' . $user->id, 'original.jpg');
            Image::make($request->file('image'))->resize(300, 300)->save('storage/images/users/' . $user->id . '/300x300.jpg');
            Image::make($request->file('image'))->resize(500, 500)->save('storage/images/users/' . $user->id . '/500x500.jpg');
        }


        session()->flash('flash_message', '登録が完了しました');
        return view('admin.user.edit', ['user' => $user, 'user_level' => $user_level]);


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
