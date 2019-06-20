<?php

use Illuminate\Database\Seeder;
use App\RentStatus;

class rentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
        	[
        		'status' => 'hold',
        		'class' => 'label label-primary'
        	],
        	[
        		'status' => 'reserved',
        		'class' => 'label label-success'
        	],
        	[
        		'status' => 'cancelled',
        		'class' => 'label label-danger'
        	],
        	[
        		'status' => 'scheduled',
        		'class' => 'label label-warning'
        	],
        	[
        		'status' => 'returned',
        		'class' => 'label label-info'
        	]
        ];

        foreach($statuses as $status){

        	RentStatus::create([

        		'status' => $status['status'],
        		'class' => $status['class']

        	]);
        }
    }
}
