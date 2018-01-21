<?php

namespace Scheduler\App\Repositories;

use Scheduler\App\Models\Institution;
use Scheduler\App\Http\Requests\InstitutionFormRequest;

class InstitutionRepository
{

	/**
	 * Save instution from form request
	 * 
	 * @param  InstitutionFormRequest $request
	 * @param  Institution            $institution
	 * 
	 * @return bool
	 */
	public function saveFromRequest(InstitutionFormRequest $request, Institution $institution)
	{

		$institution->fill($request->toArray());

		return $institution->save();


	}
}