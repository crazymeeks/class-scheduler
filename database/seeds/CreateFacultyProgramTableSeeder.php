<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateFacultyProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_program')->insert([
            'faculty_id' => 1,
            'program_id' => 1,
        ]);
    }
}
