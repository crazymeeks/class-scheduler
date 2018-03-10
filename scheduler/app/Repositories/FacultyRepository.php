<?php

namespace Scheduler\App\Repositories;

use DB;
use Closure;
use App\User;
use Illuminate\Http\Request;
use Scheduler\App\Models\Faculty;

class FacultyRepository
{

	/**
	 * Handles all registered events
	 * 
	 * @var array
	 */
	protected $events = [];

	/**
	 * Save faculty from form request
	 * 
	 * @param  Request $request
	 * @param  Faculty            $faculty
	 * 
	 * @return bool
	 */
	public function saveFromRequest(Request $request, Faculty $faculty)
	{

		$this->event('profile_photo', function($me) use($request, $faculty){
			if ($request->hasFile('profile_photo')) {
				$name = time() . '.' . $request->profile_photo->extension();

                $path =  "media/admin/faculty";
                $request->profile_photo->storeAs($path, $name, 'uploads');

                $faculty->profile_photo = "$path/$name";
                $faculty->save();
			}
		});

		try {
			DB::transaction(function() use ($faculty, $request){

				$faculty->fill($request->toArray());

				$faculty->save();
				
				$faculty->programs()->sync($request->programs);
				$faculty->specialties()->sync($request->specialties);

			});	
			
			$this->fire('profile_photo');

		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

	/**
	 * Register the event to fire later
	 * 
	 * @param  string $name      The event name to be fire
	 * @param  \Closure $callback
	 * 
	 * @return void
	 *
	 * @todo  Use laravel's event dispatcher instead of this
	 */
	private function event($name, Closure $callback)
	{
		if (!isset($this->events[$name])) {
			$this->events[$name] = $callback;
		}
	}

	/**
	 * Fire an event
	 * 
	 * @param  string $eventName
	 * 
	 * @return void
	 */
	private function fire($eventName){
		call_user_func($this->events[$eventName], $this);
	}

}