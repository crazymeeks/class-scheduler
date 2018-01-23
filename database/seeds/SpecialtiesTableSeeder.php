<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialties')->insert([
            'specialty' => 'Java',
        ]);

        DB::table('specialties')->insert([
            'specialty' => 'PHP',
        ]);

        DB::table('specialties')->insert([
            'specialty' => 'Visual Basic 6.0',
        ]);

        DB::table('specialties')->insert([
            'specialty' => 'VB.Net',
        ]);
    }
}
