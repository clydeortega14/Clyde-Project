<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalties';

    protected $fillable = ['description', 'penalty', 'per'];

    public $timestamps = false;

    public function customers()
    {

    	return $this->belongsToMany('App\Customer', 'cust_penalties', 'penalty_id', 'cust_id');
    }
}
