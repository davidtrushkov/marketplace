<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => '/account', 'middleware' => ['auth'], 'namespace' => 'Account'], function() {
	Route::get('/', 'AccountController@index')->name('account');
});