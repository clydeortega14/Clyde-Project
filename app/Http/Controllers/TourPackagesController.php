<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TourPackage;

class TourPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tourPackages = TourPackage::orderBy('created_at', 'desc')->get();
        return view('pages.tourpackages.index')->with('tourPackages', $tourPackages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tourpackages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TourPackage::create($this->tourData($request->toArray()));

        return redirect()->route('tour-packages.index')->with('message', 'New tour package has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tour = TourPackage::findOrFail($id);
        return view('pages.tourpackages.edit')->with('tour', $tour);
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
        TourPackage::where('id', $id)->update($this->tourData($request->toArray()));

        return redirect()->route('tour-packages.index')->with('message', 'Tour has been updated');
    }
    protected function tourData(Array $data){

        return [

            'description' => $data['description'],
            'rate' => $data['rate']
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TourPackage::where('id', $id)->delete();

        return redirect()->route('tour-packages.index')->with('message', 'Tour has been remove');
    }
}
