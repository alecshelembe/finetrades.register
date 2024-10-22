<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayfastController extends Controller
{
    public function createPayfastPayment(){
        return view('payfast.here'); 
    }
    public function payfastPayment(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'amount' => 'required|numeric',
            'item_name' => 'required|string',
            // Add more validation rules as necessary
        ]);
        

        // Collect all form data from the request
        $data = $request->except('_token','email','id','login_time','created_at','updated_at',); // Exclude the CSRF token from data
        
        // Passphrase and testing mode from environment variables
        $passPhrase = env('PAYFAST_PASSPHRASE', 'default_passphrase');
        $testingMode = env('PAYFAST_TESTING_MODE', true);
        // Generate the signature
        $signature = $this->generateSignature($data, $passPhrase);

        // Add the signature to the data
        $data['signature'] = $signature;

        // Determine PayFast host
        $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

        // Return the payment form partial as HTML
        return view('payfast.form', compact('data', 'pfHost'))->render();

    }


    public function generateSignature($data, $passPhrase)
    {
         // Print the data for debugging
        // print_r($data);

        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );
        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    }

    public function return_url() {
        // return view('payment.return'); 
        // Handle success case
        return response()->json(['notify' => 'success'], 200);
    }

    public function cancel_url() {
        // Handle cancel case
        return response()->json(['cancel' => 'success'], 200);
    }

    public function notify_url() {
        // Handle IPN (Instant Payment Notification) from PayFast here
        return response()->json(['status' => 'success'], 200);
    }
}
