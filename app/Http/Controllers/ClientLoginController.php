<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientLoginController extends Controller
{
    public function login(Request $request)
    {
    	try {

            $http = new \GuzzleHttp\Client;

            $response = $http->post(config('services.passport.end_point'), [

                'form_params' => [

                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ],
            ]);

            return json_decode((string) $response->getBody(), true);

    	} catch (\GuzzleHttp\Exception\BadResponseException $e) {
    		
            if($e->getCode() == 400){

                return response()->json('Bad Request', $e->getCode());

            }else if($e->getCode() == 401){

                return response('Incorrect Credentials', $e->getCode());
            }
    	}
    }

}
