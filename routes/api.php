<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/hello', 'LineBotController@hello');
Route::post('/callback', 'LineBotController@callback');
Route::post('/reservation/store', 'ReservationController@store');
Route::post('/reservation/destroy/{id}', 'ReservationController@destroy');
