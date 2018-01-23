<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            'level' => '1st year',
        ]);

        DB::table('levels')->insert([
            'level' => '2nd year',
        ]);

        DB::table('levels')->insert([
            'level' => '3rd year',
        ]);

        DB::table('levels')->insert([
            'level' => '4th year',
        ]);
    }
}
