<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';

    protected $fillable = ['customer_id', 'user_id', 'payment_amount', 'partial_pay', 'balance', 'total_penalties', 'total_payment', 'status'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class);
    }
}
