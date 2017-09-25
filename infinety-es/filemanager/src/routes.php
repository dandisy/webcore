<?php


Route::group(['prefix' => config('filemanager.defaultRoute', 'admin/filemanager') , 'middleware' => config('filemanager.middleware')], function() {

    Route::get('/', 'Infinety\FileManager\Controllers\FileManagerController@getIndex');
	Route::get('/dialog', 'Infinety\FileManager\Controllers\FileManagerController@getDialog');

	Route::post('/get_folder', 'Infinety\FileManager\Controllers\FileManagerController@ajaxGetFilesAndFolders');
	Route::post('/uploadFile', 'Infinety\FileManager\Controllers\FileManagerController@uploadFile');
	Route::post('/createFolder', 'Infinety\FileManager\Controllers\FileManagerController@createFolder');
	Route::post('/delete', 'Infinety\FileManager\Controllers\FileManagerController@delete');
	Route::get('/download', 'Infinety\FileManager\Controllers\FileManagerController@download')->where('path', '.*');
	Route::post('/preview', 'Infinety\FileManager\Controllers\FileManagerController@preview')->where('file', '.*');
	Route::post('/move', 'Infinety\FileManager\Controllers\FileManagerController@move');
	Route::post('/rename', 'Infinety\FileManager\Controllers\FileManagerController@rename')->where('file', '.*');
	Route::post('/optimize', 'Infinety\FileManager\Controllers\FileManagerController@optimize')->where('file', '.*');
});



