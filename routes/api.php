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

Route::middleware('auth:api')->get('user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest', 'throttle:10']], function() {
    Route::get('/', function() {
        return response()->json(['api' => 'v.1']);
    });
    Route::get('pushstat', ['as' => 'procedure.apps', 'uses' => 'ApiController@pushStat']);
    Route::post('pushstat', ['as' => 'procedure.apps', 'uses' => 'ApiController@pushStat']);
});
