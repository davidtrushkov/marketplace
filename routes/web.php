<?php

Auth::routes();

Route::get('register/confirm/{token}', [
	'uses' => 'Account\EmailController@confirmEmail',
	'as'   => 'verify.email',
]);

Route::post('/verification', [
	'uses' => 'Account\EmailController@confirmEmailAgain',
	'as'   => 'send.verification.code',
]);

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/account', 'middleware' => ['auth'], 'namespace' => 'Account'], function() {
	Route::get('/', 'AccountController@index')->name('account');

	Route::group(['prefix' => '/files'], function() {
		Route::get('/', 'FileController@index')->name('account.files.index');
		Route::get('/{file}/edit', 'FileController@edit')->name('account.files.edit');
		Route::patch('/{file}', 'FileController@update')->name('account.files.update');
		Route::post('/{file}', 'FileController@store')->name('account.files.store');
		Route::get('/create', 'FileController@create')->name('account.files.create.start');
		Route::get('/{file}/create', 'FileController@create')->name('account.files.create');
	});
});

Route::group(['prefix' => '/admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function() {
	Route::get('/', 'AdminController@index')->name('admin.index');

	Route::group(['prefix' => '/files'], function() {
		Route::group(['prefix' => '/new'], function() {
			Route::get('/', 'FileNewController@index')->name('admin.files.new.index');
			Route::patch('/{file}', 'FileNewController@update')->name('admin.files.new.update');
			Route::delete('/{file}', 'FileNewController@destroy')->name('admin.files.new.destroy');
		});

		Route::group(['prefix' => '/updated'], function() {
			Route::get('/', 'FileUpdatedController@index')->name('admin.files.updated.index');
			Route::patch('/{file}', 'FileUpdatedController@update')->name('admin.files.updated.update');
			Route::delete('/{file}', 'FileUpdatedController@destroy')->name('admin.files.updated.destroy');
		});
	});
});

Route::post('/{file}/upload', 'Upload\UploadController@store')->name('upload.store');
Route::delete('/{file}/upload/{upload}', 'Upload\UploadController@destroy')->name('upload.destroy');