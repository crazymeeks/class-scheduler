<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = array(
    		array('role' => 'Administrator'),
    		array('role' => 'Editor'),
    		array('role' => 'Faculty'),
    	);

        DB::table('roles')->insert($roles);
    }
}
