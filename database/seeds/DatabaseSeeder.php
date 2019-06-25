<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(roleSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(rentStatusSeeder::class);
        factory(App\Car::class, 10)->create();
        factory(App\Customer::class, 20)->create();
        factory(App\Driver::class, 15)->create();
    }
}
