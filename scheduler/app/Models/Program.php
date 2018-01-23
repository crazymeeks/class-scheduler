<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'institution_id', 'code', 'short_description'
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
        return $this->belongsToMany('Scheduler\App\Models\Faculty', 'faculty_program', 'program_id', 'faculty_id_number');
    }

    public function subjects()
    {
        return $this->belongsToMany('Scheduler\App\Models\Subject');
    }

    /**
     * 1 to Many
     */
    public function institution()
    {
    	return $this->belongsTo('Scheduler\App\Models\Institution');
    }
}
