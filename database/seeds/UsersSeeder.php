<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
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

        $this->createUsers();
    }


    protected function arrUsers()
    {
        return [

            [
                'name' => 'superadmin', 
                'email' => 'superadmin@example.com', 
                'username' => 'superadmin', 
                'password' => Hash::make('superadmin123'), 
                'status' => true
            ],

        ];
    }

    protected function createUsers()
    {
        foreach($this->arrUsers() as $user){

            $some_user = User::create([

                'name' => $user['name'],
                'email' => $user['email'],
                'username' => $user['username'],
                'password' => $user['password'],
                'status' => $user['status']
            ]);
        }
    }


}
