<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_role = array(
    		array('permission_id' => 1, 'role_id' => 1),
    	);

        DB::table('permission_role')->insert($permission_role);
    }
}
