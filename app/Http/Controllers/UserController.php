<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
//    public function index()
//    {
//        // フレンド取得
//        $users = User::all();
//        return view('admin.user.index')
//            ->with('users', $users);
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
//    public function create()
//    {
//        //
//    }

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
//        $user = User::find($id);
//        return view('admin.user.show')
//            ->with('user', $user);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function edit()
    {
        $user = User::find(Auth::id());
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function update(Request $request)
    {
        //UserをDBで見つける
        $user = User::find(Auth::id());
        if ($user) {
            //データ代入
            $user->sei = $request->sei;
            $user->mei = $request->mei;
            $user->sei_hira = $request->sei_hira;
            $user->mei_hira = $request->mei_hira;
            $user->tel = $request->tel;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            session()->flash('flash_message', '保存しました');
        }
        return redirect('/user/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
//    public function destroy($id)
//    {
//        //
//    }
}
