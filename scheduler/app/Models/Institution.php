<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 1 to Many
     */
    public function programs()
    {
    	return $this->hasMany('Scheduler\App\Models\Program');
    }

    public function faculties()
    {
        return $this->hasMany('Scheduler\App\Models\Faculty');//, 'faculty_id_number');
    }

}
