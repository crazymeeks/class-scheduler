<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateFacultyYearLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_level')->insert([
            'faculty_id_number' => 'FA-0101-2018',
            'level_id' => 1,
        ]);
    }
}
