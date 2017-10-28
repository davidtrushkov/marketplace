<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/account', 'middleware' => ['auth'], 'namespace' => 'Account'], function() {
	Route::get('/', 'AccountController@index')->name('account');

	Route::group(['prefix' => '/files'], function() {
		Route::get('/', 'FileController@index')->name('account.files.index');
		Route::post('/{file}', 'FileController@store')->name('account.files.store');
		Route::get('/create', 'FileController@create')->name('account.files.create.start');
		Route::get('/{file}/create', 'FileController@create')->name('account.files.create');
	});
});