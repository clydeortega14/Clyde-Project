<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {

	$nationality  = ['Filipino', 'American', 'Russian', 'Jamaican', 'Japanese'];
    return [
        
    	'name' => $faker->name,
    	'email' => $faker->unique()->safeEmail,
    	'address' => $faker->address,
    	'contact_number' => $faker->e164PhoneNumber,
    	'nationality' => $faker->randomElement($nationality)

    ];
});
