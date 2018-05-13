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
		 * Manage blocks
		 */
		Route::group(['prefix' => 'blocks', 'namespace' => 'Block'], function(){

			Route::get('/', 'BlockController@indexView');

			/**
			 * Create new block
			 */
			Route::get('create', 'BlockController@create');
			Route::get('{id}/edit', 'BlockController@edit');

			Route::post('/save', 'BlockController@save');
			Route::delete('{id}/delete', 'BlockController@delete');
			Route::put('{id}/update', 'BlockController@update');			

		});

		/**
		 * Manage Semester
		 */
		Route::group(['prefix' => 'semesters', 'namespace' => 'Semester'], function(){

			Route::get('/', 'SemesterController@indexView');

			/**
			 * Create new semester
			 */
			// Route::get('create', 'BlockController@create');
			// Route::get('{id}/edit', 'BlockController@edit');

			Route::post('/save', 'SemesterController@save');
			Route::delete('{id}/delete', 'SemesterController@delete');
			Route::put('{id}/update', 'SemesterController@update');			

		});

		/**
		 * Manage Semester Class size
		 */
		Route::group(['prefix' => 'class-size', 'namespace' => 'Semester'], function(){

			Route::get('/', 'ClassSizeController@indexView');

			/**
			 * Create new semester
			 */
			Route::get('create', 'ClassSizeController@create');
			Route::get('{id}/edit', 'ClassSizeController@edit');
			Route::get('/index-data', 'ClassSizeController@getData');
			Route::post('/save', 'ClassSizeController@save');
			Route::delete('{id}/delete', 'ClassSizeController@delete');
			Route::put('{id}/update', 'ClassSizeController@update');			

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

		/**
		 * Set Priority
		 */
		Route::group(['prefix' => 'set-priority', 'namespace' => 'Priority'], function(){

			Route::get('/faculties', 'SetPriorityController@subjectToFacultyView');
			Route::get('/ajax-get-faculties', 'SetPriorityController@getFaculties');
			// Add faculty load/subject
			Route::get('faculty/{id}', 'SetPriorityController@formAssignSubjectToFacultyView');
			Route::post('/', 'SetPriorityController@assign');

			// this is for Integration test only
			// Remove this
			Route::post('/delete', 'SetPriorityController@delete');


			Route::get('/subjects', 'SetPriorityController@assignSubjectView');
			Route::get('/ajax-get-subjects', 'SetPriorityController@getSubjects');
			Route::get('subject/{id}', 'SetPriorityController@formAssignSubjectView');
			Route::post('subjects', 'SetPriorityController@assign');

		});

		/**
		 * Room Management
		 */
		Route::group(['namespace' => 'Room'], function(){

			//Route::post('/', 'RoomController@manage');
			Route::resources(['rooms' => 'RoomController']);

		});
	});
});