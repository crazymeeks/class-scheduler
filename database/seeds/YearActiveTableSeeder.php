<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearActiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('year_active')->insert([
            'year' => '2015',
        ]);

        DB::table('year_active')->insert([
            'year' => '2016',
        ]);

        DB::table('year_active')->insert([
            'year' => '2017',
        ]);

        DB::table('year_active')->insert([
            'year' => '2018',
        ]);
    }
}
