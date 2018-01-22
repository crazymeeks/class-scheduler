<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_types')->insert([
            'faculty_type_unit_id' => 1,
            'type' => 'Regular'
        ]);
    }
}
