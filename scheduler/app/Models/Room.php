<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    
    use SoftDeletes;

	/**
	 * Fillable fields
	 * 
	 * @var array
	 */
    protected $fillable = [
    	'name', 'type', 'description',
    	'status', 'deleted_at'
    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function fixed_class_schedules()
    {
        return $this->hasMany(FixedClassSchedule::class);
    }
}
