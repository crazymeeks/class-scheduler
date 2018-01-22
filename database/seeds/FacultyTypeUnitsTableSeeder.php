<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyTypeUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faculty_type_units')->insert([
            'min_units' => '18',
            'max_units' => '24'
        ]);
    }
}
