<?php

use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinations = [

        	[
        		'destination' => 'Cebu City',
        		'rate' => 1500.00
        	],
        	[
        		'destination' => 'Argao',
        		'rate' => 2500.00
        	],
        	[
        		'destination' => 'Dalaguete',
        		'rate' => 3000.00
        	],
        	[
        		'destination' => 'Alcoy',
        		'rate' => 3500.00
        	],
        	[
        		'destination' => 'Badian',
        		'rate' => 5000.00
        	]

        ];

        foreach($destinations as $destination){

        	App\Destination::create([

        		'destination' => $destination['destination'],
        		'rate' => $destination['rate']
        	]);
        }
    }
}
