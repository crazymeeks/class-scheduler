<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin'], function(){

	Route::group(['namespace' => 'Admin'], function(){
		
		Route::get('/', 'Dashboard\DashboardController@indexView');

		/**
		 * Manage institution
		 */
		Route::group(['prefix' => 'institution', 'namespace' => 'Institution'], function(){

			Route::get('/', 'InstitutionController@indexView');

			/**
			 * Create new institution
			 */
			Route::get('create', 'InstitutionController@create');
			Route::post('/save', 'InstitutionController@save');
			Route::post('/delete', 'InstitutionController@delete');
		});
	});
});