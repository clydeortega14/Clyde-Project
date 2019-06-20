<?php

use Illuminate\Database\Seeder;
use App\TourPackage;

class TourPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tour_Packages = [

        	[
        		'description' => 'Cebu round Trip', 
        		'rate' => 7500.00
        	],
        	[
        		'description' => 'Busay Promo Trip',
        		'rate' => 1999.00
        	]

        ];

        foreach($tour_Packages as $tour){

        	TourPackage::create([

        		'description' => $tour['description'],
        		'rate' => $tour['rate']
        	]);
        }
    }
}
