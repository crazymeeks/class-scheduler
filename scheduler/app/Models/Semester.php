<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Scheduler\App\Models\Program;
class Semester extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
    	'semester'
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
    public function programs()
    {
    	return $this->belongsToMany(Program::class);
    }

}
