<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'address', 'contact_number', 'nationality'];

    public function penalties()
    {
    	return $this->belongsToMany('App\Penalty', 'cust_penalties', 'cust_id', 'penalty_id');
    }
    public function customerData(Array $data){

    	return [

    		'name' => $data['name'],
    		'email' => $data['email'],
    		'address' => $data['address'],
    		'contact_number' => $data['contact_no'],
    		'nationality' => $data['nationality']
    	];
    }
}
