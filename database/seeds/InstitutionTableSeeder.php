<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            'name' => 'Institute of Information Technology',
        ]);

        DB::table('institutions')->insert([
            'name' => 'College of Engineering',
        ]);

        DB::table('institutions')->insert([
            'name' => 'College of Education',
        ]);
    }
}
