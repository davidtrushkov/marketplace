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

Route::get('/account/connect', 'Account\MarketPlaceConnectController@index')->name('account.connect');
Route::get('/account/connect/complete', 'Account\MarketPlaceConnectController@store')->name('account.complete');

Route::group(['prefix' => '/account', 'middleware' => ['auth'], 'namespace' => 'Account'], function() {
	Route::get('/', 'AccountController@index')->name('account');
	Route::get('/bought/files', 'AccountController@boughtIndex')->name('bought.files');
	Route::post('/upload/avatar', 'AvatarController@store')->name('account.user.avatar');
	Route::post('/update/settings', 'AccountController@update')->name('account.update.settings');

	Route::group(['prefix' => '/files', 'middleware' => ['needs.marketplace']], function() {
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
	Route::get('/{file}', 'FileController@show')->name('admin.files.show');

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

	Route::get('/users/all', 'AdminController@users')->name('admin.users.all');
	Route::post('impersonate/{id}', 'AdminController@impersonate')->name('admin.impersonate');
});

Route::delete('impersonate/delete', 'Admin\AdminController@destroyImpersonate')->name('admin.impersonate.delete');

Route::group(['prefix' => '/{file}/checkout', 'namespace' => 'Checkout'], function() {
	Route::post('/free', 'CheckoutController@free')->name('checkout.free');
	Route::post('/payment', 'CheckoutController@payment')->name('checkout.payment');
});

Route::post('/{file}/upload', 'Upload\UploadController@store')->name('upload.store');
Route::delete('/{file}/upload/{upload}', 'Upload\UploadController@destroy')->name('upload.destroy');

Route::get('/files', 'Files\FileController@index')->name('files.index');
Route::get('/{file}', 'Files\FileController@show')->name('files.show');
Route::get('/{file}/{sale}/download', 'Files\FileDownloadController@show')->name('files.download');

Route::group(['middleware' => ['auth']], function() {
	Route::post('/store/comment/{id}', 'Files\FileController@storeComment')->name('store.comment');
	Route::post('/store/comment/reply/{file}/{id}', 'Files\FileController@storeReply')->name('store.comment.reply');

	Route::group(['middleware' => ['auth', 'admin']], function() {
		Route::delete('/destroy/comment/{id}/{fileId}', 'Files\FileController@destroyComment')->name('destroy.comment');
	});
});