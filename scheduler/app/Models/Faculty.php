<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    
    use SoftDeletes;

    // public $incrementing = false;

    // protected $primaryKey = 'id_number';

    protected $fillable = [
    	'faculty_id_number', 'faculty_type_id', 'institution_id',
    	'lastname', 'firstname', 'middlename', 'email','password',
        'remember_token', 'gender','address', 'graduated_school_name',
        'other_school', 'degree', 'major', 'minor', 'minimum_units',
        'maximum_units', 'earned_ma', 'ms_mba', 'phd', 'special_training',
        'years_of_experience', 'basic_salary', 'assignment', 'position',
        'status', 'deleted_at'
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
    	return $this->belongsToMany('Scheduler\App\Models\Subject')->withPivot('year_created');//, 'faculty_subject', 'faculty_id_number', 'subject_id');
    }

    public function specialties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Specialty');//, 'faculty_specialty', 'faculty_id_number', 'specialty_id');
    }

    public function programs()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Program');//, 'faculty_program', 'faculty_id_number', 'program_id');
    }

    public function levels()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Level');//, 'faculty_level', 'faculty_id_number', 'level_id');
    }

    public function year_actives()
    {
        return $this->belongsToMany('Scheduler\App\Models\YearActive');//, 'faculty_year_active', 'faculty_id_number', 'year_active_id');
    }

    /**
     * 1 to Many
     */
    public function faculty_type()
    {
    	return $this->belongsTo('Scheduler\App\Models\FacultyType');
    }

    public function institution()
    {
    	return $this->belongsTo('Scheduler\App\Models\Institution');
    }

    /**
     * Scope
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
