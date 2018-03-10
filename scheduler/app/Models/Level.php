<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'level', 'deleted_at',
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
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_level', 'level_id', 'faculty_id_number');
    }

    public function blocks()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Block');
    }

    public function subject()
    {
        return $this->hasMany('Scheduler\App\Models\Subject');
    }
}
