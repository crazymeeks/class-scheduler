<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'name' => '101',
            'type' => 'Lab',
            'description' => 'Computer Laboratory',
            'status' => 1,
        ]);
    }
}
