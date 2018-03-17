<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;

class FacultyPrioritySubject extends Model
{

	protected $table = 'faculty_priority_subject';
    
    protected $fillable = ['faculty_id', 'subject_id', 'created_at', 'updated_at'];

}
