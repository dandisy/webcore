<?php

use Illuminate\Http\Request;
use Webcore\Elorest\Elorest;

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

Elorest::routes();
// Elorest::routes([
//     'middleware' => ['auth:api', 'throttle:60,1'],
//     // 'only' => ['post', 'put', 'patch', 'delete'],
//     'except' => ['get']
// ]);

/*
|--------------------------------------------------------------------------
| EloREST - Using client credentials
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => 'client_credentials'], function () {
    // EloREST script here!
});
