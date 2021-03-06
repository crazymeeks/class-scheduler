<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\ClassSize;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Semester extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
    	'semester'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Many to Many
     */
    public function programs()
    {
    	return $this->belongsToMany(Program::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function class_sizes()
    {
        return $this->hasMany(ClassSize::class);
    }

    public function fixed_class_schedules()
    {
        return $this->hasMany(FixedClassSchedule::class);
    }

}
