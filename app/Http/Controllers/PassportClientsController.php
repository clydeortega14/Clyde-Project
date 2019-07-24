<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class PassportClientsController extends Controller
{
    
    public function __construct()
    {

    	$this->middleware('guest');
    }

    public function show()
    {

    	return view('pages.passport-clients.show');
    }
    public function getBackup()
    {

		// Execute php artisan back up run
		$execute = Artisan::call('backup:run', [
    		'--only-db' => true,
    	]);

    	return 'successfully back up';
    }
}
