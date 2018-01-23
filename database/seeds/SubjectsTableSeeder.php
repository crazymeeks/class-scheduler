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
            'units'             => '3',
            'name'              => 'Turbo C',
        ]);

        DB::table('subjects')->insert([
            'units'             => '6',
            'name'              => 'Thesis',
        ]);
    }
}
