<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
        	'institution_id' => 1,
            'code' => 'COP',
            'short_description' => 'Computer Operation & Programming',
        ]);

        DB::table('programs')->insert([
        	'institution_id' => 1,
            'code' => 'BSIT',
            'short_description' => 'Bachelor of Science in Information & Technology',
        ]);
    }
}
