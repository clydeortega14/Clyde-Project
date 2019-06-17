<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {

	$gender = ['male', 'female'];
	$nationality = ['Filipino', 'Jamaican', 'Brazilian', 'Chinese'];

    return [
        
        'name' => $faker->name,
        'address' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'contact_no' => $faker->phoneNumber,
        'gender' => $faker->randomElement($gender),
        'birthdate' => $faker->date($format = 'Y-m-d'),
        'nationality' => $faker->randomElement($nationality),
        'available' => $faker->boolean,
    ];
});
