<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'level_id'          => 1,
            'subject_type_id'   => 1,
            'semester_id'       => 1,
            'units'             => '3',
            'name'              => 'Programming Language 1',
            'code'              => 'PL 1',
        ]);

        DB::table('subjects')->insert([
            'level_id'          => 1,
            'subject_type_id'   => 1,
            'semester_id'       => 2,
            'units'             => '6',
            'name'              => 'Programming Language 2',
            'code'              => 'PL 2',
        ]);
    }
}
