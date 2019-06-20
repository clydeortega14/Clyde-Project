<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    protected $table = 'rent_cars';
    protected $fillable = ['customer_id', 'car_id', 'pick_up_address', 'drop_off_date', 'status_id'];
}
