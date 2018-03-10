<?php

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

Route::group(['namespace' => 'Auth'], function(){

	// Route::get('/', function(){
	// 	return bcrypt('password');
	// });

	Route::get('/', 'LoginController@loginView');

	Route::post('post-login', 'LoginController@postAuthenticate');

	Route::post('logout', 'LoginController@logout');
});

Route::group(['namespace' => 'Api', 'prefix' => 'api'], function(){
	Route::group(['prefix' => 'v1'], function(){

		Route::group(['prefix' => 'users'], function(){

			Route::get('verify-password', 'UsersController@verifyPassword');
		});
	});
});