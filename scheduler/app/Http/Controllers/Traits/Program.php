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
            'page_title' => 'Institution::Add program',
            'url' => url('admin/programs/save'),
            'id'  => $id,
        ];

		return admin_view('pages.programs.form', $data);
	}

	/**
	 * Create new program
	 */
	public function saveProgram(Request $request, $id = null)
	{


		$this->validateData($request, $id);

		$program = new ProgramModel;

		$successMessage = 'New program has been saved.';
		$errorMessage = 'Error occured while saving program. Please try again';

		if (!is_null($id)) {
			$program = ProgramModel::find($id);

			$successMessage = 'Program has been updated.';
			$errorMessage = 'Error occured while updating program. Please try again';
		}

		$program->fill($request->toArray());

		$program->institution_id = $request->institution;

		$location = $request->has('redirect_flag') ? 'admin/institution/' . $request->institution . '/view-program' : 'admin/programs';

		if ($program->save()) {
    		return redirect($location)->with('success', $successMessage);
		}
		
    	return redirect($location)->with('error', $errorMessage);
	}

	/**
	 * Validate request data
	 *
	 * @param  \Illuminate\Http\Request $request
	 * 
	 * @return \Illuminate\Http\Response
	 */
	private function validateData(Request $request, $program_id = null)
	{
		
		$code_validate = !is_null($program_id)
                    ? 'required|unique:programs,code,' . $program_id . ',id'
                    : 'required|unique:programs';

		$request->validate([
            'institution' => 'required',
            'code' => $code_validate,
            'short_description' => 'required',
        ]);
	}

}