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

















Route::resource('posts', 'PostController');















Route::resource('pages', 'PageController');

Route::resource('articles', 'ArticleController');

Route::resource('article2s', 'Article2Controller');