<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Destination;
use DataTables;
use DB;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.destinations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Destination::create($this->destinationData($request->toArray()));

        return back()->with('message', 'Destination successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);

        return view('pages.destinations.index')->with('destination', $destination);
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

        DB::beginTransaction();

        try {
                        
            Destination::where('id', $id)->update($this->destinationData($request->toArray()));

        } catch (Exception $e) {
            
            DB::rollback();

            return redirect()->route('destinations.edit', ['id' => $id])->withError('message', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('destinations.index')->with('message', 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Destination::where('id', $id)->delete();

        return redirect()->route('destinations.index')->with('message', 'deleted');
    }
    protected function destinationData(Array $data)
    {
        return [

            'destination' => $data['destination'],
            'rate' => $data['rate'],
        ];
    }
    public function getDestination(){

        return DataTables::of(Destination::query())
        ->editColumn('rate', function(Destination $destination){

            return number_format($destination->rate, 2);
        })->addColumn('action', function(Destination $destination){

            $url = route('destinations.edit', ['id' => $destination->id]);

            return "<a href='{$url}' class='btn btn-primary btn-sm btn-flat' data-toggle='tooltip' title='Edit'>
                        <i class='fa fa-edit'></i>
                    </a>";
        })->rawColumns(['action'])
        ->make(true);
    }
}
