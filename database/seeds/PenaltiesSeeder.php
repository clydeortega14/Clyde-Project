<?php

use Illuminate\Database\Seeder;

class PenaltiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penalties = [

        	[
        		'description' => 'Late returned',
        		'penalty' => 100.00,
        		'per' => 'per hour'
        	],
        	[
        		'description' => 'Damage',
        		'penalty' => 1000.00,
        		'per' => null
        	],
        	[
        		'description' => 'Exceed destinations',
        		'penalty' => 1000.00,
        		'per' => 'kilometer'
        	]
        ];

        foreach ($penalties as $key => $value) {
        	
        	App\Penalty::create([

        		'description' => $value['description'],
        		'penalty' => $value['penalty'],
        		'per' => $value['per']
        	]);
        }
    }
}
