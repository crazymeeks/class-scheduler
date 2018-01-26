<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;

class YearActive extends Model
{
    
    protected $table = 'year_active';
    
    protected $fillable = [
    	'year',
    ];

    /**
     * Many to Many
     */
    public function faculties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_year_active', 'year_active_id', 'faculty_id_number');
    }
}
