<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateFacultyPrioritySubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_priority_subject')->insert([
            'faculty_id' => 1,
            'subject_id' => 1,
        ]);

        DB::table('faculty_priority_subject')->insert([
            'faculty_id' => 1,
            'subject_id' => 2,
        ]);
    }
}
