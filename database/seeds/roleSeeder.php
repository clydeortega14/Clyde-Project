<?php

use Illuminate\Database\Seeder;
use App\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [

        	['name' => 'superadmin', 'display_name' => 'Superadmin', 'description' => 'Has access to all'],
        	
        ];

        foreach($roles as $role){

        	$add_role = Role::create([

                'name' => $role['name'],
        		'display_name' => $role['display_name'], 
        		'description' => $role['description']

        	]);
        }
    }
}
