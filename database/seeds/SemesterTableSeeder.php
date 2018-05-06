<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
        	'semester' => '1st semester',
        ]);

        DB::table('semesters')->insert([
        	'semester' => '2nd semester',
        ]);

        DB::table('semesters')->insert([
        	'semester' => '3rd semester',
        ]);

        DB::table('semesters')->insert([
        	'semester' => '4th semester',
        ]);
    }
}
