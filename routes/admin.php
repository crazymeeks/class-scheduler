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
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){

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
			Route::get('{id}/edit', 'InstitutionController@edit');
			Route::get('{id}/view-program', 'InstitutionController@viewPrograms');
			Route::get('program-manage-block/{id}', 'InstitutionController@viewManageBlocks');

			Route::post('/save', 'InstitutionController@save');
			Route::post('/delete', 'InstitutionController@delete');
			Route::post('{id}/update', 'InstitutionController@update');
			Route::post('program-block-save/{id}', 'InstitutionController@saveProgramBlock');

			/**
			 * Create new Program under an institution
			 */
			Route::get('{id}/view-program/create', 'InstitutionController@createProgram');			

		});

		/**
		 * Manage Faculty
		 */
		Route::group(['prefix' => 'faculty', 'namespace' => 'Faculty'], function(){
			Route::get('/', 'FacultyController@indexView');
			Route::get('{id}/edit', 'FacultyController@edit');
			Route::get('create', 'FacultyController@create');
			Route::get('{id}/view-faculty-load', 'FacultyController@ajaxViewFacultyLoad');

			Route::post('/save', 'FacultyController@save');
			Route::post('{id}/update', 'FacultyController@update');
			Route::post('delete/{id}', 'FacultyController@delete');

		});

		/**
		 * Manage Subject
		 */
		Route::group(['prefix' => 'subject', 'namespace' => 'Subject'], function(){
			Route::get('/', 'SubjectController@indexView');
			Route::get('{id}/edit', 'SubjectController@edit');
			Route::get('{id}/view-subject-programs', 'SubjectController@ajaxViewSubjectPrograms');
			Route::get('create', 'SubjectController@create');

			Route::post('/save', 'SubjectController@save');
			Route::post('{id}/update', 'SubjectController@update');
			Route::post('delete/{id}', 'SubjectController@delete');
			Route::post('delete-all', 'SubjectController@deleteAll');
		});

		/**
		 * Manage Program
		 */
		Route::group(['prefix' => 'programs', 'namespace' => 'Program'], function(){
			Route::get('/', 'ProgramController@indexView');
			Route::get('{id}/edit', 'ProgramController@edit');
			Route::get('create', 'ProgramController@create');

			Route::post('save/{id?}', 'ProgramController@saveProgram');
			Route::post('delete/{id}', 'ProgramController@delete');
		});
	});
});