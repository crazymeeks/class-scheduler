<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyType extends Model
{

	use SoftDeletes;
	
    protected $fillable = [
    	'faculty_type_unit_id', 'type',
    ];

    /**
     * 1 to Many
     */
    public function faculties()
    {
    	return $this->hasMany('Scheduler\App\Models\Faculty');
    }

    public function faculty_type_unit()
    {
    	return $this->belongsTo('Scheduler\App\Models\FacultyTypeUnit');
    }
}
