<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
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
        $notes = (new \App\Models\User)->getNotes($id);

        return view('admin.user.show', compact('user', 'notes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function edit($id)
    {
        $user_level = User::getLevelAll();

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
        $rules = [
            'image' => 'image|max:15360',
        ];
        $this->validate($request, $rules);

        $user_level = User::getLevelAll();
        //UserをDBで見つける
        $user = User::find($id);
        //データ代入
        $user->sei = $request->sei;
        $user->mei = $request->mei;
        $user->sei_hira = $request->sei_hira;
        $user->mei_hira = $request->mei_hira;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->self_introduction = $request->self_introduction;
        //DBへ保存
        $user->save();

        //画像保存先作成
        $path = public_path('storage/images/users');
        if (!(new Filesystem)->isDirectory($path)) {
            (new Filesystem)->makeDirectory($path, 0777, true);
        }

        if ($request->image) {
            $exif = Image::make($request->image)->exif();
            $width = 300;
            $height = $exif['COMPUTED']['Height'] / ($exif['COMPUTED']['Width'] / $width);
            $request->file('image')->storeAs('public/images/users/' . $user->id, 'original.jpg');
            Image::make($request->file('image'))->resize($width, $height)->save('storage/images/users/' . $user->id . '/w300.jpg');

            $width = 500;
            $height = $exif['COMPUTED']['Height'] / ($exif['COMPUTED']['Width'] / $width);
            Image::make($request->file('image'))->resize($width, $height)->save('storage/images/users/' . $user->id . '/w500.jpg');

            /// 1000
            Image::make($request->file('image'))->crop(1000, 700, 20, 0)->save('storage/images/users/' . $user->id . '/1000x700.jpg');
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
