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

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

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
        Route::get('/', function () {
            return view('admin.welcome');
        });
        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
        Route::get('home', 'Admin\HomeController@index')->name('admin.home');
        Route::resource('user', 'UserController');
        Route::resource('player', 'PlayerController');
    });
});
