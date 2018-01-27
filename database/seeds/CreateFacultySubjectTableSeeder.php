<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateFacultySubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_subject')->insert([
            'faculty_id' => 1,
            'subject_id' => 1,
            'created_at' => date('Y'),
        ]);
    }
}
