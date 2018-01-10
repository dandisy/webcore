<?php

use App\Models\Page;
//use App\Models\MenuItem;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Contracts\Filesystem\Filesystem;

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

Route::get('/', function () {
    // return redirect('home');
    return view('welcome');
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home', function () {
//     return MenuItem::renderAsHtml();
// });

Route::get('/admin', function () {
    //if(Laratrust::hasRole(['administrator','superadministrator'])) {
        return redirect('dashboard');
    // } else {
    //     return redirect('home');
    // }
});

Route::group(['middleware' => 'auth'], function () {    
    Route::get('oauth-admin', function() {
        return view('oauth.index');
    });
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'HomeController@index');

    Route::get('menu-manager', function () {
        return view('menu::index');
    });

    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
        Route::resource('users', 'UserController');

        Route::resource('roles', 'RoleController');

        // Route::resource('permissions', 'PermissionController');

        Route::resource('settings', 'SettingController');
    });
});

Route::get('/img/{path}', function(Filesystem $filesystem, $path) {
    $server = ServerFactory::create([
        'response' => new LaravelResponseFactory(app('request')),
        'source' => $filesystem->getDriver(),
        'cache' => $filesystem->getDriver(),
        'cache_path_prefix' => '.cache',
        'base_url' => 'img',
    ]);

    return $server->getImageResponse($path, request()->all());

})->where('path', '.*');