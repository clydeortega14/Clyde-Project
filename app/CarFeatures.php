<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarFeatures extends Model
{
    protected $table = 'car_features';

    protected $fillable = ['car_id', 'features'];

    protected $timestamps = false;
}
