<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    protected $table = 'penalties';

    protected $fillable = ['description', 'penalty', 'per'];

    public $timestamps = false;
}
