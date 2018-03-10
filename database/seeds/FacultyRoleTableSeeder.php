<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultyRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty_role = array(
    		array('faculty_id' => 1, 'role_id' => 1),
    	);

        DB::table('faculty_role')->insert($faculty_role);
    }
}
