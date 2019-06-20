<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class RentCarsController extends Controller
{
    public function showReservationForm()
    {
    	$cars = Car::select(['id', 'model', 'no_of_setters'])->orderBy('created_at', 'desc')->get();
    	
    	return view('pages.rent-cars.show-reserve-form')->with('cars', $cars);
    }
    public function postReservation(Request $request)
    {
    	return $request->toArray();
    }

}
