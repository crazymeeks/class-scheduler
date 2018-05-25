<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FixClassScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fixed_class_schedule')->insert([
            'semester_id'  => 1,
            'program_id'   => 1,
            'level_id'     => 1,
            'block_id'     => 1,
            'subject_id'   => 1,
            'day_id'       => 1,
            'room_id'      => 1,
            'faculty_id'   => 1,
            'start_time'   => '9:30AM',
            'end_time'     => '10:30AM',
        ]);
    }
}
