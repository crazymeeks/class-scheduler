<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\Semester;
use Scheduler\App\Models\ClassSize;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'institution_id', 'code', 'short_description',
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
    public function blocks()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Block');
    }

    public function faculties()
    {
        return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_program', 'program_id', 'faculty_id_number');
    }

    public function subjects()
    {
        return $this->belongsToMany('Scheduler\App\Models\Subject');
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    /**
     * 1 to Many
     */
    public function institution()
    {
    	return $this->belongsTo('Scheduler\App\Models\Institution');
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
