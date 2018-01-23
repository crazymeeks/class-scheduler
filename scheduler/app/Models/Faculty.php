<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    
    use SoftDeletes;

    protected $primaryKey = 'id_number';

    protected $fillable = [
    	'id_number', 'faculty_type_id', 'institution_id',
    	'lastname', 'firstname', 'middlename', 'status',
    	'deleted_at'
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
    public function subjects()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Subject', 'faculty_subject', 'faculty_id_number', 'subject_id');
    }

    public function specialties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Specialty', 'faculty_specialty', 'faculty_id_number', 'specialty_id');
    }

    public function programs()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Program', 'faculty_program', 'faculty_id_number', 'program_id');
    }

    public function levels()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Level', 'faculty_level', 'faculty_id_number', 'level_id');
    }

    /**
     * 1 to Many
     */
    public function facultyType()
    {
    	return $this->belongsTo('Scheduler\App\Models\FacultyType', 'faculty_type_id', 'id_number');
    }

    public function institution()
    {
    	return $this->belongsTo('Scheduler\App\Models\Institution', 'institution_id', 'id_number');
    }
}
