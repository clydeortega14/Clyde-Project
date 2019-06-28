<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = ['customer_id', 'user_id', 'total_payment_amt', 'amount_paid', 'balance', 'status'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
