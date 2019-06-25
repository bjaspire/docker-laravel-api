<?php

use Illuminate\Http\Request;

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


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',
    'as' => 'api.'

], function ($router) {

    Route::post('login', 'API\V1\AuthController@login')->name('login');
    Route::post('logout', 'API\V1\AuthController@logout')->name('logout');
    Route::post('refresh', 'API\V1\AuthController@refresh')->name('refresh');
    Route::post('me', 'API\V1\AuthController@me')->name('me');
    Route::resource('transaction', 'API\V1\TransactionController', ['except' => ['create', 'edit']]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
