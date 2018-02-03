<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateFacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculties')->insert([
            'faculty_id_number' => 'FA-0101-2018',
            'faculty_type_id' => 1,
            'institution_id' => 1,
            'lastname' => 'Doe',
            'firstname' => 'John',
            'email'     => 'mhelannie@rsu.ph',
            'password'     => bcrypt('secret'),
            'gender' => 'Female',
            'address' => 'Odiongan, Romblon',
            'graduated_school_name' => 'Romblon State University',
            'other_school' => 'TIP Manila',
            'degree' => 'Bachelor of Science in Information Technology',
            'major' => 'Math',
            'minor' => 'PE',
            'minimum_units' => 18.5,
            'maximum_units' => 24,
            'years_of_experience' => 10,
            'basic_salary' => 12000,
        ]);
    }
}
