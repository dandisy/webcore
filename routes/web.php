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

Route::get('/home', 'HomeController@index');

Route::resource('menus', 'MenuController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('users', 'UserController');

Route::resource('posts', 'PostController');

Route::resource('settings', 'SettingController');

Route::resource('pages', 'PageController');





Route::resource('profiles', 'ProfileController');