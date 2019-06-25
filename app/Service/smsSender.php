<?php 


namespace App\Service;

class smsSender
{

	static function sendSms($contactNo, $text)
	{
		$api_key = env('NEXMO_KEY');
	    $api_secret = env('NEXMO_SECRET');

	    $basic  = new \Nexmo\Client\Credentials\Basic($api_key, $api_secret);
	    $client = new \Nexmo\Client($basic);

	    try {
	        
	        $message = $client->message()->send([
	            
	            'to' => $contactNo,
	            'from' => 'QS Ventures',
	            'text' => $text
	        ]);

	    } catch (Exception $e) {
	        
	        return response()->json(['message' => $e->getMessage()]);
	    }
	}
}

