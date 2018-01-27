<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'units', 'hours', 'name', 'deleted_at',
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
    	return $this->belongsToMany('Scheduler\App\Models\Program');
    }

    public function faculties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_subject', 'subject_id', 'faculty_id_number');
    }
}
