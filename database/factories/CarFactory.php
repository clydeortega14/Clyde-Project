<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Car;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {

	$carBrands = ['Honda', 'Nissan', 'Ford', 'volkswagen', 'Mercedes', 'Suzuki', 'KIA'];
	$carModels = ['Honda - Civic', 'Nissan - Almera', 'Ford - Everest', 'volkswagen - Fiction', 'Mercedes - Bench', 'Suzuki - raider', 'KIA - Picanto'];
	$numbers = '1234567890';

    return [
        
    	'brand' => $faker->randomElement($carBrands),
    	'model' => $faker->randomElement($carModels),
    	'plate_no' => Str::random(5).' - '.str_limit(str_shuffle($numbers), 5, ''),
    	'maxperson' => $faker->randomDigit,
    	'available' => $faker->boolean	

    ];
});
