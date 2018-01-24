<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateFacultySpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_specialty')->insert([
            'faculty_id_number' => 'FA-0101-2018',
            'specialty_id' => 1,
        ]);
    }
}
