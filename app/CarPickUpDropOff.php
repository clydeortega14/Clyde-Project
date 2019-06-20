<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarPickUpDropOff extends Model
{
    protected $table = 'car_pick_up_drop_off';

    protected $fillable = ['car_id', 'pick_up', 'drop_off', 'rate'];
    
    public $timestamps = false;
}
