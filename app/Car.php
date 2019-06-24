<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = ['brand', 'model', 'description', 'no_of_setters', 'plate_no', 'available'];
}
