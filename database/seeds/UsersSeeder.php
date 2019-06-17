<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [

            [
                'name' => 'Admin Panel',
                'email' =>  'admin@example.com',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role_id' => 1,
                'active' => true
            ],
            [
                'name' => 'Staff',
                'email' => 'Staff@example.com',
                'username' => 'staff',
                'password' => Hash::make('staff123'),
                'role_id' => 2,
                'active' => true,
            ]
        ];

        foreach($users as $user){

            User::create([
                'name' => $user['name'],
                'email' =>  $user['email'],
                'username' => $user['username'],
                'password' => $user['password'],
                'role_id' => $user['role_id'],
                'active' => $user['active']
            ]);
        }

    }
}
