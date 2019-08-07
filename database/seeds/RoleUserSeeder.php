<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data() as $role_user){

        	$this->roleUserCreate($role_user);
        }
    }

    protected function data()
    {
    	return [

    		['user_id' => 1, 'role_id' => 1]
    	];
    }
    protected function roleUserCreate(Array $roleuser)
    {
    	DB::table('role_user')->insert([
    		'user_id' => $roleuser['user_id'], 
    		'role_id' => $roleuser['role_id']
    	]);
    }
}
