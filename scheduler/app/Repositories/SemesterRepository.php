<?php

namespace Scheduler\App\Repositories;

use DB;
use Scheduler\App\Models\Semester;
use Scheduler\App\Http\Requests\SemesterFormRequest;
use Scheduler\App\Exceptions\DBTransactionException;

class SemesterRepository
{

	/**
	 * Save or update data from request
	 *
	 * @param  SemesterFormRequest $request
	 * 
	 * @return bool
	 */
	public function saveFromRequest(SemesterFormRequest $request, Semester $semester)
	{

		try {
			DB::transaction(function() use ($semester, $request){

				$semester->fill($request->toArray());

				$semester->save();

			});

		} catch (\Exception $e) {
			throw new DBTransactionException($e->getMessage(), $e->getCode());
		}

		return true;
	}

	/**
	 * Delete block
	 *
	 * @param  int $id      The model id
	 *
	 * @return  bool
	 *
	 * @todo  Check if model successfully deleted
	 */
	public function delete($id)
	{
		Semester::find($id)->delete();

		return true;
	}
}