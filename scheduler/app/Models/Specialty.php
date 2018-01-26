<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'specialty', 'deleted_at',
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
    public function faculties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_specialty', 'specialty_id', 'faculty_id_number');
    }
}
