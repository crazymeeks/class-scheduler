<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateFacultyYearActiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_year_active')->insert([
            'faculty_id' => 1,
            'year_active_id' => 1,
        ]);
    }
}
