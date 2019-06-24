<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $table = 'tour_packages';
    protected $fillable = ['description', 'rate'];
}
