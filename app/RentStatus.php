<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RentStatus extends Model
{
    protected $table = 'rent_status';
    
    protected $fillable = ['status'];

    public $timestamps = false;
}
