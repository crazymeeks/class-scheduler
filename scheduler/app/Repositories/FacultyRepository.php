<?php

namespace Scheduler\App\Repositories;

use DB;
use App\User;
use Illuminate\Http\Request;
use Scheduler\App\Models\Faculty;

class FacultyRepository
{

	/**
	 * Save faculty from form request
	 * 
	 * @param  Request $request
	 * @param  Faculty            $faculty
	 * 
	 * @return bool
	 */
	public function saveFromRequest(Request $request, Faculty $faculty, User $user)
	{

		try {
			DB::transaction(function() use ($faculty, $request, $user){

				$faculty->fill($request->toArray());
				$user->fill($request->toArray());

				$faculty->save();
				
				$faculty->programs()->sync($request->programs);
				$faculty->specialties()->sync($request->specialties);
				$user->faculty_id = $faculty->id;
				$user->save();
				

			});	
			
		} catch (\Exception $e) {
			return false;
		}

		return true;


	}
}