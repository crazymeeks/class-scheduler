<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    

	/**
	 * Fillable fields
	 * 
	 * @var array
	 */
    protected $fillable = [
    	'role'
    ];

    /**
     * Many to Many
     */
    public function faculties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');
    }

    public function permissions()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Permission');
    }
}
