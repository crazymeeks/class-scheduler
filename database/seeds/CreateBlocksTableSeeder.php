<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CreateBlocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP1BLK1',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP1BLK2',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP1BLK3',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP1BLK4',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP2BLK1',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP2BLK2',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP2BLK3',
        ]);

        DB::table('blocks')->insert([
            'program_id' => 1,
            'code' => 'COP2BLK4',
        ]);
    }
}
