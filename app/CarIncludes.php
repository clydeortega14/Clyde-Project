<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarIncludes extends Model
{
    protected $table = 'car_includes';

    protected $fillable = ['car_id', 'includes'];

    protected $timestamps = false;
}
