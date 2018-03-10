<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_types')->insert([
            'name'          => 'Lecture',
        ]);

        DB::table('subject_types')->insert([
            'name'          => 'Lab',
        ]);
    }
}
