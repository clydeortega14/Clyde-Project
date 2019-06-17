<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::orderBy('created_at', 'desc')->get();
        
        return view('pages.cars.index')->with('cars', $cars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Car::create($this->carDetails($request->toArray()));

        return redirect()->route('cars')->with('message', 'New car was successfully created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('pages.cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Car::where('id', $id)->update($this->carDetails($request->toArray()));
        return redirect()->route('cars')->with('message', 'Car Details updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::where('id', $id)->delete();
        return redirect()->route('cars')->with('message', 'Car deleted!');
    }

    protected function carDetails(Array $data)
    {

        return [

            'brand' => $data['brand'],
            'model' => $data['model'],
            'plate_no' => $data['plate_no'],
            'maxperson' => $data['max_person'],
            'available' => true
        ];
    }
}
