<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    protected $fillable = [
    	'permission'
    ];

    /**
     * Many to Many
     */
    public function roles()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Role');
    }
}
