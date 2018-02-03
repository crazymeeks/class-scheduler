<?php

namespace Scheduler\App\Http\Controllers\Traits;


use Illuminate\Http\Request;
use Scheduler\App\Models\Program as ProgramModel;

/**
 * This trait is use to create a new program
 */

trait Program
{

	/**
	 * Display create program form
	 *
	 * @param  \Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function createProgram(Request $request, $id = null)
	{
		$data = [
            'page_title' => 'Institution::Create',
            'url' => url('admin/program/save'),
            'id'  => $id,
        ];

		return admin_view('pages.programs.form', $data);
	}

	/**
	 * Create new program
	 */
	public function saveProgram(Request $request)
	{


		$this->validateData($request);

		$program = new ProgramModel;

		$program->fill($request->toArray());

		$program->institution_id = $request->institution;

		$location = $request->has('redirect_flag') ? 'admin/institution/' . $request->institution . '/view-program' : 'admin/programs';

		if ($program->save()) {
    		return redirect($location)->with('success', 'New program has been saved.');
		}
		
    	return redirect($location)->with('error', 'Error occured while saving program. Please try again.');
	}

	/**
	 * Validate request data
	 *
	 * @param  \Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
	private function validateData(Request $request)
	{
		$request->validate([
            'institution' => 'required',
            'code' => 'required',
            'short_description' => 'required',
        ]);
	}

}