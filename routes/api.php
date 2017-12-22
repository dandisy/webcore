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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// start resource example
Route::get('product', function () {
    return [
        ['id' => '123', 'name' => 'dummy product 1', 'price' => '1000'],
        ['id' => '234', 'name' => 'dummy product 2', 'price' => '5'],
        ['id' => '345', 'name' => 'dummy product 3', 'price' => '90151'],
    ];
})->middleware('auth:api');

$posts = [
    ['id' => '123', 'title' => 'blog post 1', 'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'],
    ['id' => '234', 'title' => 'blog post 2', 'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'],
    ['id' => '345', 'title' => 'blog post 3', 'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'],
];

Route::get('post', function () use ($posts) {
    return $posts;
});

Route::get('post/{id}', function ($id) use ($posts) {
    $key = array_search($id, array_column($posts, 'id'));
    if (false !== $key) {
        return $posts[$key];
    }
    return [];
});
// end resource example

//Route::resource('menus', 'MenuAPIController');

Route::resource('users', 'UserAPIController');

Route::resource('roles', 'RoleAPIController');

Route::resource('permissions', 'PermissionAPIController');

//Route::resource('settings', 'SettingAPIController');

//Route::resource('pages', 'PageAPIController');

