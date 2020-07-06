<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'basicauth'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('login/line', 'Auth\LoginController@socialLogin');
    Route::get('login/line/loginCallback', 'Auth\LoginController@handleProviderCallback');
    // 予約
    Route::resource('/reservation', 'ReservationController');
//    Route::get('/user/{user_id}/edit', 'UserController@edit')->name('line-user.edit');
//    Route::put('/user/{user_id}', 'UserController@update')->name('line-user.update');
    Route::resource('player', 'PlayerController');

    /**
     * ログイン後
     */
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    // ユーザー
    Route::get('/user/edit', 'UserController@edit')->name('user.edit');
    Route::put('/user/update', 'UserController@update')->name('user.update');

    /**
     * ログイン前
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('/', function () {
            return view('admin.welcome');
        });
        Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
        Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
        Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');
        Route::get('password/rest', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    });

    /**
     * ログイン後
     */
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', 'Admin\HomeController@index')->name('admin.home');
        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
        Route::get('home', 'Admin\HomeController@index')->name('admin.home');
        Route::resource('user', 'Admin\UserController')->names([
            'edit' => 'admin.user.edit',
            'show' => 'admin.user.show',
            'update' => 'admin.user.update',
        ]);
        Route::resource('player', 'Admin\PlayerController');
        Route::resource('reservation', 'ReservationController');
        Route::resource('course', 'Admin\CourseController');
        Route::resource('store', 'Admin\StoreController');
        Route::resource('note','Admin\NoteController');
        Route::get('note/{post}/post', 'Admin\NoteController@post')->name('note.post');
    });
});
