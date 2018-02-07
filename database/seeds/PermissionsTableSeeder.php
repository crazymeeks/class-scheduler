<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array(
    		array('permission' => 'all'),
    		array('permission' => 'can_add_subject'),
    		array('permission' => 'can_add_faculty'),
    		array('permission' => 'can_add_institution'),
    		array('permission' => 'can_add_program'),
    		array('permission' => 'can_set_priority'),
    		array('permission' => 'can_add_priority'),
    		array('permission' => 'can_add_role'),
    		array('permission' => 'can_add_permission'),
    		// edit
    		array('permission' => 'can_edit_subject'),
    		array('permission' => 'can_edit_faculty'),
    		array('permission' => 'can_edit_institution'),
    		array('permission' => 'can_edit_program'),
    		array('permission' => 'can_edit_priority'),
    		array('permission' => 'can_edit_faculty'),
    		array('permission' => 'can_edit_role'),
    		array('permission' => 'can_edit_permission'),
    		// delete
    		array('permission' => 'can_delete_faculty'),
    		array('permission' => 'can_delete_subject'),
    		array('permission' => 'can_delete_institution'),
    		array('permission' => 'can_delete_program'),
    		array('permission' => 'can_delete_priority'),
    		array('permission' => 'can_delete_role'),
    		array('permission' => 'can_delete_permission'),
    	);

        DB::table('permissions')->insert($permissions);
    }
}
