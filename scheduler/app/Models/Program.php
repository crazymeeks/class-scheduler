<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'institution_id', 'code', 'short_description'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Program hasMany Block
     */
    public function blocks()
    {
    	return $this->hasMany('Scheduler\App\Models\Block');
    }

    /**
     * Program belongsTo Institution
     */
    public function institution()
    {
    	return $this->belongsTo('Scheduler\App\Models\Institution');
    }
}
