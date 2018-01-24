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
            'faculty_id_number' => 'FA-0101-2018',
            'subject_id' => 1,
        ]);
    }
}
