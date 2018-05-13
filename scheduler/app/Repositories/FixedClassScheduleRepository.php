<?php

namespace Scheduler\App\Repositories;

use DB;
use Scheduler\App\Models\FixedClassSchedule;
use Scheduler\App\Exceptions\DBTransactionException;
use Scheduler\App\Http\Requests\FixedClassScheduleFormRequest;

class FixedClassScheduleRepository
{

	/**
	 * Save or update data from request
	 *
	 * @param  ClassSizeFormRequest $request
	 * 
	 * @return bool
	 */
	public function saveFromRequest(FixedClassScheduleFormRequest $request, FixedClassSchedule $fsched)
	{
		try {
			DB::transaction(function() use ($fsched, $request){

				$fsched->fill($request->toArray());
				$fsched->semester_id = $request->semester;
				$fsched->program_id = $request->program;
				$fsched->level_id = $request->level;
				$fsched->block_id = $request->block;
				$fsched->subject_id = $request->subject;
				$fsched->day_id = $request->day;
				$fsched->room_id = $request->room;
				$fsched->faculty_id = $request->faculty;
				$fsched->start_time = $request->start_time;
				

				$fsched->save();

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
		FixedClassSchedule::find($id)->delete();

		return true;
	}
}