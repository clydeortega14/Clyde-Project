<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\TourPackage;
use App\BookTour;
use App\Customer;
use DB;

class BookToursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = BookTour::orderBy('date_of_tour', 'asc')->get();

        return view('pages.tourpackages.bookings.index')->with('tours', $tours);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tours = TourPackage::where('available', true)->orderBy('id', 'desc')->get();

        return view('pages.tourpackages.bookings.book-tour')->with('tours', $tours);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //validator
        $this->validation($request);

        DB::beginTransaction();

        try {
            //CREATE CUSTOMER
            $customer = new Customer;
            //STORE CUSTOMER 
            $create_customer = Customer::create($customer->customerData($request->toArray()));

            //INITIALIZE BOOKING DATA
            $book_tour = new BookTour;

            //STORE CUSTOMER BOOKINGS
            $create_bookings = BookTour::create($book_tour->bookTourData($request->toArray(), $create_customer->id));

        } catch (Exception $e) {
            
            DB::rollback();

            return back()->withErrors('errors', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('book-tours.index')->with('message', 'save successfully');
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
       $booked_tour = BookTour::findOrFail($id);
       $tours = TourPackage::where('available', true)->orderBy('id', 'desc')->get();

        return view('pages.tourpackages.bookings.book-tour')
            ->with('booked_tour', $booked_tour)
            ->with('tours', $tours);
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
        $booked_tour = BookTour::findOrFail($id);

        DB::beginTransaction();

        try {
            
            $customer = new Customer; // create new customer instance
            $update_customer = Customer::where('id', $booked_tour->customer_id)->update($customer->customerData($request->all())); // update customer details

            $tour_bookings = new BookTour; //create new BookTour instance
            $update_tour_bookings = BookTour::where('id', $id)->update($tour_bookings->bookTourData($request->all(), $booked_tour->customer_id)); // update booked tour details


        } catch (Exception $e) {
            
            DB::rollback();

            return back()->withError('message', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('book-tours.index')->with('message', 'Successfull updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function validation(Request $request)
    {
        $validateData = $request->validate([

            'name' => 'required',
            'email' => 'required|unique:customers',
            'address' => 'required|max:255',
            'contact_no' => 'required',
            'no_of_person' => 'required|integer',
            'tour_date' => 'required|date',
            'pick_time' => 'required',
            'pick_address' => 'required|max:355',
            'tour_package' => 'required'
        ]);

        return $validateData;
    }
}
