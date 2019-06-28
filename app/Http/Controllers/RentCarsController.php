<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\RentCar;
use App\Customer;
use App\RentStatus;
use App\Destination;
use DataTables;
use DB;
use App\Service\smsSender;

class RentCarsController extends Controller
{
    public function index()
    {
        return view('pages.rent-cars.index');
    }
    public function showReservationForm()
    {
    	$cars = Car::select(['id', 'model', 'no_of_setters'])->where('available', true)->orderBy('created_at', 'desc')->get();
        $destinations = Destination::all();
    	
    	return view('pages.rent-cars.show-reserve-form')
            ->with('destinations', $destinations)
            ->with('cars', $cars);
    }
    public function postReservation(Request $request)
    {
        //VALIDATE REQUEST

        DB::beginTransaction();

        try {
            
            // STORE CUSTOMER
            $customer = Customer::create($this->CustomerData($request->toArray()));

            if($customer){

                $message = 'Good day'.' '.$customer->name.' '.'your reservation trip to boracay is now available ';

                //SEND SMS TO CLIENT
                smsSender::sendSms($customer->contact_number, $message);
            }

            //STORE CAR
            RentCar::create($this->rentData($request->toArray(), $customer->id));
            

        } catch (Exception $e) {
            
            //if error catches database will be rollback
            DB::rollBack();

            return back()->withErrors($e->getMessage());
        }

        //if the code we are trying to execute has no errors
        //then data will be commit to the database
        DB::commit();
       
        return redirect()->route('rent.list')->with('message', 'Successfully Added');
    }
    public function updateReservation(Request $request, $id)
    {
        $rent = RentCar::findOrFail($id);

        DB::beginTransaction();

        try {

            Customer::where('id', $rent->customer_id)->update($this->CustomerData($request->toArray())); // Update customer details

            RentCar::where('id', $rent->id)->update($this->rentData($request->toArray(), $rent->customer_id)); //Update rent details

        } catch (Exception $e) {

            DB::rollBack();

            return redirect()->route('rent.list')->withErrors($e->getMessage());
        }

        DB::commit();

        return redirect()->route('rent.list')->with('message', 'Successfully Updated');
        
    }
    public function edit($id)
    {
        $rent = RentCar::findOrFail($id);
        $cars = Car::select(['id', 'model', 'no_of_setters'])->orderBy('created_at', 'desc')->get();
        $destinations = Destination::all();
        $rentStatus = RentStatus::all();

        return view('pages.rent-cars.show-reserve-form')
        ->with('cars', $cars)
        ->with('destinations', $destinations)
        ->with('rentStatus', $rentStatus)
        ->with('rent', $rent);
    }
    protected function rentData(Array $data, $customer_id)
    {

        $pickUp = date_create($data['pick_up_date']);
        $dropOff = date_create($data['drop_off_date']);

        return [

            'customer_id' => $customer_id,
            'car_id' => $data['car_id'],
            'destination_id' => $data['destination_id'],
            'pick_up_address' => $data['pick_up_address'],
            'pick_up_date' => date_format($pickUp, 'Y-m-d'),
            'drop_off_date' => date_format($dropOff, 'Y-m-d'),
            'status_id' => isset($data['status']) ? $data['status'] : 1,
        ];
    }
    protected function CustomerData(Array $data)
    {
        return [

            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'contact_number' => $data['contact_no'],
            'nationality' => $data['nationality']
        ];
    }

    public function showRentData()
    {
        $rentals = RentCar::with(['customer', 'car', 'destination', 'status'])->orderBy('created_at', 'desc');

        return datatables()->eloquent($rentals)

        ->addColumn('customer', function(RentCar $rent){

            return $rent->customer->name;

        })->addColumn('contact', function(RentCar $rent){

            return $rent->customer->contact_number;
        })
        ->addColumn('car', function(RentCar $rent){

            return $rent->car->model;

        })->addColumn('destination', function(RentCar $rent){

            return $rent->destination->destination;
        })
        ->addColumn('status', function(RentCar $rent){

            return "<span class='{$rent->status->class}'>{$rent->status->status}</span>";

        })->addColumn('action', function(RentCar $rent){

            $url = route('rent-list.edit', ['id' => $rent]);

            return "<a href='{$url}' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-edit'></i></a>";

        })->rawColumns(['action', 'status'])
        ->toJson();
    }
    public function eventListData()
    {
        return response()->json(RentCar::with(['customer', 'car', 'status'])->get());
    }
}
