<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    protected $table = 'rent_cars';
    protected $fillable = ['customer_id', 'car_id', 'pick_up_address', 'pick_up_date', 'drop_off_date', 'status_id'];

    public function customer()
    {
    	return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
    public function car()
    {
    	return $this->hasOne('App\Car', 'id', 'car_id');
    }
    public function status()
    {
    	return $this->hasOne('App\RentStatus', 'id', 'status_id');
    }
}
