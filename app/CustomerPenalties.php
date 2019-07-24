<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPenalties extends Model
{
    protected $table = 'cust_penalties';
    protected $fillable = ['cust_id', 'penalty_id'];
}
