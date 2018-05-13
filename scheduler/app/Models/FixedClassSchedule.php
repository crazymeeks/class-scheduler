<?php

namespace Scheduler\App\Models;

use Scheduler\App\Models\Day;
use Scheduler\App\Models\Room;
use Scheduler\App\Models\Block;
use Scheduler\App\Models\Level;
use Scheduler\App\Models\Program;
use Scheduler\App\Models\Subject;
use Scheduler\App\Models\Faculty;
use Scheduler\App\Models\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FixedClassSchedule extends Model
{

	use SoftDeletes;

    protected $table = 'fixed_class_schedule';

    protected $fillable = [
    	'semester_id', 'program_id', 'level_id',
    	'block_id', 'subject_id', 'day_id', 'room_id',
    	'faculty_id', 'start_time', 'end_time', 'deleted_at'
    ];

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

    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }

    public function day()
    {
    	return $this->belongsTo(Day::class);
    }

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }
}
