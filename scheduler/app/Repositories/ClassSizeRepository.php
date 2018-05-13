<?php

namespace Scheduler\App\Repositories;

use DB;
use Scheduler\App\Models\ClassSize;
use Scheduler\App\Http\Requests\ClassSizeFormRequest;
use Scheduler\App\Exceptions\DBTransactionException;

class ClassSizeRepository
{

	/**
	 * Save or update data from request
	 *
	 * @param  ClassSizeFormRequest $request
	 * 
	 * @return bool
	 */
	public function saveFromRequest(ClassSizeFormRequest $request, ClassSize $csize)
	{
		try {
			DB::transaction(function() use ($csize, $request){

				$csize->program_id = $request->program;
				$csize->semester_id = $request->semester;
				$csize->level_id = $request->level;
				$csize->block_id = $request->block;
				$csize->size = $request->size;

				$csize->save();

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
		ClassSize::find($id)->delete();

		return true;
	}
}