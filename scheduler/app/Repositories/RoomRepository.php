<?php

namespace Scheduler\App\Repositories;

use DB;
use Closure;
use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Http\Requests\RoomRequest;
class RoomRepository
{


	/**
	 * Save faculty from form request
	 * 
	 * @param  Request $request
	 * @param  Faculty            $faculty
	 * 
	 * @return void
	 *
	 * @throws  \Exception
	 */
	public function saveFormRequest(RoomRequest $request, Room $room)
	{

		DB::transaction(function() use ($room, $request){

			$room->fill($request->toArray());

			$room->save();

		});
	}

	/**
	 * Soft delete room
	 * 
	 * @return bool
	 */
	public function delete(Room $room)
	{
		return $room->delete();
	}

}