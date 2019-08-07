<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data() as $perm_role){

        	$this->createPermissionRole($perm_role);
        }
    }

    protected function data()
    {
    	return [

    		['permission_id' => 1, 'role_id' => 1],
    		['permission_id' => 2, 'role_id' => 1],
    		['permission_id' => 3, 'role_id' => 1],
    	];
    }

    protected function createPermissionRole(Array $perm_role)
    {
    	return DB::table('permission_role')->insert([

    		'permission_id' => $perm_role['permission_id'],
    		'role_id' => $perm_role['role_id']
    	]);
    }
}
