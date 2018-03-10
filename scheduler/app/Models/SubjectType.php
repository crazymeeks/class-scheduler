<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectType extends Model
{
    
	use SoftDeletes;

	protected $table = 'subject_types';

   /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function subjects()
    {
    	return $this->hasMany('Scheduler\App\Models\Subject');
    }
}
