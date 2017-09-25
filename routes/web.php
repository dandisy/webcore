<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    //Route::resource('menus', 'MenuController');

    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
        Route::resource('users', 'UserController');

        //Route::resource('settings', 'SettingController');
    });

    Route::group(['middleware' => ['role:superadministrator']], function () {
        Route::resource('roles', 'RoleController');

        Route::resource('permissions', 'PermissionController');
    });

    //Route::resource('pages', 'PageController');
});
