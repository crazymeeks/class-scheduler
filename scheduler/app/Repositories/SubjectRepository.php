<?php

namespace Scheduler\App\Repositories;

use DB;
use Illuminate\Http\Request;
use Scheduler\App\Models\Subject;

class SubjectRepository
{

	/**
	 * Save subject from form request
	 * 
	 * @param  \Illuminate\Http\Request $request
	 * @param  Scheduler\App\Models\Subject    $subject
	 * 
	 * @return bool
	 */
	public function saveFromRequest(Request $request, Subject $subject)
	{

		try {
			DB::transaction(function() use ($subject, $request){

				$subject->fill($request->toArray());

				if ($request->has('subject_name')) {
					$subject_name = $request->subject_name;
					$request->request->remove('subject_name');
					$request->request->add(['name' => $subject_name]);
				}

				$subject->save();
			});	
			
		} catch (\Exception $e) {
			return false;
		}

		return true;


	}
}