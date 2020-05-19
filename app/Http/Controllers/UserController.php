<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

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
     * @return void
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(empty($user) === FALSE) {
            return view('edit', ['user' => $user]);

        }else{
           $test = config('app.env');
           if($test === 'development'){
            $qr_code = asset('storage/images/dev.png');
            return view('qrcode')->with('qr_code', $qr_code);
           }elseif ($test === 'production') {
               $qr_code = asset('storage/images/test.png');
               return view('qrcode')->with('qr_code', $qr_code);
           }else{
               echo 'Please check env file';
           }
        }

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
        //UserをDBで見つける
        $user = User::find($id);
        //データ代入
        $user->sei = $request->sei;
        $user->mei = $request->mei;
        $user->sei_hira = $request->sei_hira;
        $user->mei_hira = $request->mei_hira;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->password = $request->password;
        //DBへ保存
        $user->save();

        echo '登録ありがとうございます！';


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
