<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\Block;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSize extends Model
{
    
    use SoftDeletes;

    protected $table = 'class_size';

    protected $fillable = [
    	'semester_id', 'program_id', 'level_id',
    	'block_id', 'size'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
    }

    public function program()
    {
    	return $this->belongsTo(Program::class);
    }

    public function level()
    {
    	return $this->belongsTo(Level::class);
    }

    public function block()
    {
    	return $this->belongsTo(Block::class);
    }
}
