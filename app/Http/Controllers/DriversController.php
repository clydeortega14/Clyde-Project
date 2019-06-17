<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Driver::orderBy('created_at', 'desc')->get();

        return view('pages.drivers.index')->with('drivers', $drivers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Driver::create($this->driverDetails($request->toArray()));

        return redirect()->route('drivers.index')->with('message', 'New driver has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::findOrFail($id);

        return view('pages.drivers.edit')->with('driver', $driver);
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
        Driver::where('id', $id)->update($this->driverDetails($request->toArray()));

        return redirect()->route('drivers.index')->with('message', 'driver has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Driver::where('id', $id)->delete();

        return redirect()->route('drivers.index')->with('message', 'driver has been deleted');
    }

    protected function driverDetails(Array $data){

        return [

            'name' => $data['name'],
            'address' => $data['address'],
            'email' => $data['email'],
            'contact_no' => $data['contact_no'],
            'gender' => $data['gender'],
            'birthdate' => $data['birthdate'],
            'nationality' => $data['nationality'],
            'available' => true,

        ];
    }
}
