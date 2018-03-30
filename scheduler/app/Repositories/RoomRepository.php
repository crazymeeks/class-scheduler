<?php

namespace Scheduler\App\Repositories;

use DB;
use Closure;
use Illuminate\Http\Request;
use Scheduler\App\Models\Room;
use Scheduler\App\Models\Faculty;
//use Scheduler\App\Http\Requests\RoomRequest;
class RoomRepository
{


	/**
	 * The model
	 * 
	 * @var Scheduler\App\Models\Room
	 */
	protected $room;

	/**
	 * Constructor
	 * 
	 * @param Scheduler\App\Models\Room $room
	 */
	public function __construct(Room $room)
	{
		$this->room = $room;
	}

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
	public function saveFormRequest(Request $request)
	{

		// echo "<pre>";
		// print_r($request->all());exit;
		$room = $this->room;
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
	public function delete()
	{
		return $this->room->delete();
	}

}