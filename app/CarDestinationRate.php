<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarDestinationRate extends Model
{
    protected $table = 'car_destination_rates';

    protected $fillable = ['car_id', 'destination', 'rate'];

    protected $timestamps = false;
}
