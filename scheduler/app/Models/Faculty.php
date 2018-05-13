<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\Role;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\Specialty;
use Scheduler\App\Models\YearActive;
use Scheduler\App\Models\Institution;
use Scheduler\App\Models\FacultyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Scheduler\App\Models\FixedClassSchedule;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    
    use SoftDeletes, Notifiable;
    
    protected $fillable = [
    	'faculty_id_number', 'faculty_type_id', 'institution_id','profile_photo',
        'lastname', 'firstname', 'middlename', 'email','password','remember_token',
        'gender','address', 'graduated_school_name','other_school', 'degree', 'major',
        'minor', 'minimum_units','maximum_units', 'earned_ma', 'ms_mba', 'phd', 'special_training',
        'years_of_experience', 'basic_salary', 'assignment', 'position','status', 'deleted_at'
    ];

    protected $hidden = [
        'remember_token'
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
    	return $this->belongsToMany(Subject::class)->withPivot('year_created');//, 'faculty_subject', 'faculty_id_number', 'subject_id');
    }

    public function specialties()
    {
    	return $this->belongsToMany(Specialty::class);//, 'faculty_specialty', 'faculty_id_number', 'specialty_id');
    }

    public function programs()
    {
    	return $this->belongsToMany(Program::class);//, 'faculty_program', 'faculty_id_number', 'program_id');
    }

    public function levels()
    {
    	return $this->belongsToMany(Level::class);//, 'faculty_level', 'faculty_id_number', 'level_id');
    }

    public function year_actives()
    {
        return $this->belongsToMany(YearActive::class);//, 'faculty_year_active', 'faculty_id_number', 'year_active_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * 1 to Many
     */
    public function faculty_type()
    {
    	return $this->belongsTo(FacultyType::class);
    }

    public function institution()
    {
    	return $this->belongsTo(Institution::class);
    }

    public function fixed_class_schedules()
    {
        return $this->hasMany(FixedClassSchedule::class);
    }

    /**
     * Scope
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
