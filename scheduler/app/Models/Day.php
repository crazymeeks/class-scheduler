<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{

	use SoftDeletes;	

	protected $fillable = [
		'code', 'delete_at'
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
