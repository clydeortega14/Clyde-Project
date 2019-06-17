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

        	['display_name' => 'Admin', 'description' => 'Has access to all'],
        	['display_name' => 'Staff', 'description' => 'Limited Access'],
        ];

        foreach($roles as $role){

        	Role::create([

        		'display_name' => $role['display_name'], 
        		'description' => $role['description']

        	]);
        }
    }
}
