<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultyTypeUnit extends Model
{

	use SoftDeletes;

    protected $fillable = [
    	'min_units', 'max_units'
    ];

    /**
     * 1 to Many
     */
    public function faculty_types()
    {
    	return $this->hasMany('Scheduler\App\Models\FacultyType');
    }
}
