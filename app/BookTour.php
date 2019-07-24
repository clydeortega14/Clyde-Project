<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookTour extends Model
{
    protected $table = 'book_tours';

    protected $fillable = ['customer_id', 'tour_id', 'no_of_persons', 'date_of_tour', 'pick_up_time', 'pick_up_address'];

    public function bookTourData(Array $data, $customerId)
    {

    	return [

    		'customer_id' => $customerId,
    		'tour_id' => $data['tour_package'],
    		'no_of_persons' => $data['no_of_person'],
    		'date_of_tour' => $data['tour_date'],
    		'pick_up_time' => date('H:i:s', strtotime($data['pick_time'])),
    		'pick_up_address' => $data['pick_address']

    	];
    }
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
