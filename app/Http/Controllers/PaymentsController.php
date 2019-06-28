<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Payments;
use App\RentCar;
use App\Car;
use App\Penalty;
use DataTables;
use DB;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rents = RentCar::whereNotIn('status_id', [3, 5])->get();

        return view('pages.payments.create')->with('rents', $rents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();

        try {
            
            $payment = Payments::create($this->paymentsData($request->toArray(), auth()->user()->id));

            if($payment){

                //UPDATE RESERVATION STATUS
                RentCar::where('customer_id', $payment->customer_id)->update(['status_id' => 2]);

                //UPDATE CAR AVAILABILITY
                Car::where('id', $payment->car_id)->update(['available' => false]);
            }

        } catch (Exception $e) {
            
            DB::rollback();

            return redirect()->route('payments.index')->withErrors('message', $e->getMessage());
        }

        DB::commit();

        return redirect()->route('payments.index')->with('message', 'Payment successfully created');
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
        $payment = Payments::findOrFail($id);
        $rents = RentCar::whereNotIn('status_id', [3, 5])->get();
        $penalties = Penalty::all();

        return view('pages.payments.create')
            ->with('rents', $rents)
            ->with('penalties', $penalties)
            ->with('payment', $payment);
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
        //
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

    protected function paymentsData(Array $data, $userid)
    {
        return [

            'customer_id' => $data['customer_id'],
            'user_id' => $userid,
            'total_payment_amt' => $data['pay_amount'],
            'amount_paid' => $data['amount_paid'],
            'balance' => $data['balance'],
            'status' => 'partial'
        ];

    }
    public function getPaymentsData()
    {
        $customer_payments = Payments::with(['customer'])->orderBy('created_at', 'desc');

        return datatables()->eloquent($customer_payments)

        ->addColumn('customer', function(Payments $payment){

            return $payment->customer->name;

        })->editColumn('total_payment_amt', function(Payments $payment){

            return number_format($payment->total_payment_amt, 2);

        })->editColumn('amount_paid', function(Payments $payment){

            return number_format($payment->amount_paid, 2);

        })->editColumn('balance', function(Payments $payment){

            return number_format($payment->balance, 2);

        })->addColumn('status', function(Payments $payment){

            if($payment->status == 'partial'){

                return "<span class='label label-warning'>Partial</span>";

            }else if($payment->status == 'paid'){

                return "<span class='label label-success'>Paid</span>";
            }
        })
        ->addColumn('action', function(Payments $payment){

            $url = route('payments.edit', ['id' => $payment->id]);

            return "<a href='{$url}' class='btn btn-primary btn-sm btn-flat' data-toggle='tooltip' title='Edit'>
                        <i class='fa fa-edit'></i>
                    </a>";
        })->rawColumns(['action', 'status'])
        ->toJson();
    }

    public function getDestinationRate($custId)
    {
        $a = RentCar::where('customer_id', $custId)->first();

        return response()->json(['customerID' => $a->destination->rate]);
    }
}
