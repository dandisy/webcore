<?php

//use App\Models\MenuItem;
use Illuminate\Http\Request;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Auth;

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
    // if(Laratrust::hasRole(['administrator','superadministrator'])) {
        return redirect('dashboard');
    // } else {
    //     return redirect('home');
    // }
});

Route::get('edit-profile', function(ProfileRepository $profileRepository) {
    return view('profiles.edit')->with('profile', $profileRepository->findWhere(['user_id' => Auth::user()->id])->first());
});

Route::group(['middleware' => 'auth'], function () {
    // Route::get('endpoint', function(\Illuminate\Http\Request $request) {
    //     return $request->all();
    // });

    // Route::get('oauth-admin', function() {
    //     return view('oauth.index');
    // });

    // Route::get('dashboard', 'HomeController@index');
    Route::get('dashboard', function() {
        return view('dashboard');
    });

    Route::get('analytics', 'HomeController@index');

    // Route::get('menu-manager', function () {
    //     return view('menu::index');
    // });
    
    // handling edit profile non superadmin
    Route::post('users', 'UserController@store')->name('users.store');
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::put('users/{users}', 'UserController@update')->name('users.update');
    Route::patch('users/{users}', 'UserController@update')->name('users.update');
    Route::get('users/{users}/edit', 'UserController@edit')->name('users.edit');
    Route::post('profiles', 'ProfileController@store')->name('profiles.store');
    Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
    Route::put('profiles/{profiles}', 'ProfileController@update')->name('profiles.update');
    Route::patch('profiles/{profiles}', 'ProfileController@update')->name('profiles.update');
    Route::get('profiles/{profiles}/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::group(['middleware' => ['role:superadministrator']], function () {
        // Route::resource('users', 'UserController');
        Route::get('users', 'UserController@index')->name('users.index');
        // Route::post('users', 'UserController@store')->name('users.store');
        // Route::get('users/create', 'UserController@create')->name('users.create');
        // Route::put('users/{users}', 'UserController@update')->name('users.update');
        // Route::patch('users/{users}', 'UserController@update')->name('users.update');
        Route::delete('users/{users}', 'UserController@destroy')->name('users.destroy');
        Route::get('users/{users}', 'UserController@show')->name('users.show');

        // Route::resource('profiles', 'ProfileController');
        Route::get('profiles', 'ProfileController@index')->name('profiles.index');
        // Route::post('profiles', 'ProfileController@store')->name('profiles.store');
        // Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
        // Route::put('profiles/{profiles}', 'ProfileController@update')->name('profiles.update');
        // Route::patch('profiles/{profiles}', 'ProfileController@update')->name('profiles.update');
        Route::delete('profiles/{profiles}', 'ProfileController@destroy')->name('profiles.destroy');
        Route::get('profiles/{profiles}', 'ProfileController@show')->name('profiles.show');

        Route::resource('roles', 'RoleController');

        Route::resource('permissions', 'PermissionController');
    });

    Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
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