<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function socialLogin()
    {
        return Socialite::driver('line')->redirect();
    }

    /**
     * ソーシャルログイン
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('line')->stateless()->user();
        $user = \App\Models\User::where(['id' => $userSocial->id])->first();
        if ($user) {
            \App\Models\User::where('id', $user->id)
                ->update(['display_name' => $userSocial->getName(), 'email' => $userSocial->getEmail(), 'picture_url' => $userSocial->avatar]);
            Auth::login($user);
        } else {
            $newUser = new \App\Models\User();
            $newUser->id = $userSocial->id;
            $newUser->display_name = $userSocial->getName();
            $newUser->email = $userSocial->getEmail();
            $newUser->picture_url = $userSocial->avatar;
            $newUser->save();
            //そのままログイン
            Auth::login($newUser);
        }
        return redirect('/home');
    }
}
