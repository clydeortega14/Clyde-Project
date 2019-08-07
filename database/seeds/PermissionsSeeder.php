<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data() as $permission){

        	$this->createPermission($permission);
        }
    }

    public function data()
    {
    	return [

    		['name' => 'create-user', 'display_name' => 'Create user', 'description' => 'Can Create new user'],
    		['name' => 'edit-user', 'display_name' => 'edit user', 'description' => 'Can edit existing user'],
    		['name' => 'delete-user', 'display_name' => 'delete user', 'description' => 'Can delete existing user'],

    	];
    }

    public function createPermission(Array $permission)
    {
    	return Permission::create([

    		'name' => $permission['name'],
    		'display_name' => $permission['display_name'],
    		'description' => $permission['description']
    	]);
    }
}
