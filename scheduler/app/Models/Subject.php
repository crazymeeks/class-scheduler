<?php

namespace Scheduler\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'name', 'code', 'short_description', 'subject_type_id',
        'level_id', 'status', 'units', 'hours', 'deleted_at',
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

    public function faculties()
    {
    	return $this->belongsToMany('Scheduler\App\Models\Faculty');//, 'faculty_subject', 'subject_id', 'faculty_id_number');
    }

    public function level()
    {
        return $this->belongsTo('Scheduler\App\Models\Level');
    }

    public function subject_type()
    {
        return $this->belongsTo('Scheduler\App\Models\SubjectType');
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
