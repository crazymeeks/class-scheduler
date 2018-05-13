<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\ClassSize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Block extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'code'
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
    	return $this->belongsToMany('Scheduler\App\Models\Program');
    }

    public function levels()
    {
        return $this->belongsToMany('Scheduler\App\Models\Level');
    }

    public function class_sizes()
    {
        return $this->hasMany(ClassSize::class);
    }
}
