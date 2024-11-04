<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyRegistration;
use Carbon\Carbon;

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
            'item_description' => 'required|string',
            'email' => 'required|email',
            // Add more validation rules as necessary
        ]);

        // Collect all form data from the request
        $data = $request->except('_token','email','id','login_time','created_at','updated_at','payment_status'); // Exclude the CSRF token from data
        
        // Fetch the registration record
        $registration = DailyRegistration::where('email', $data['email_address'])
        ->where('login_time', '>=', Carbon::now()->subDay())
        ->first();
        
        // Update fields
        $registration->amount = $data['amount']; // Set newAmount to the desired value
        $registration->item_description = $data['item_description']; // Set newAmount to the desired value
        $registration->save(); // Save the changes to the database

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
        // Set PayFast host based on the environment
        $testingMode = env('PAYFAST_TESTING_MODE', true);
        $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
    
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referrerHost = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
    
            if ($referrerHost === $pfHost) {
                // Get the email of the currently logged-in user
                $email = auth()->user()->email;
    
                $registration = DailyRegistration::where('email', $email)
                    ->where('login_time', '>=', Carbon::now()->subDay())
                    ->first();
    
                if ($registration) {
                    // Update fields
                    $registration->payment_status = 'Success';

                    session(['payment_status' => $registration->payment_status]);

                    $registration->save();
    
                    return response()->json(['notify' => 'success'], 200);
                } else {
                    return response()->json(['error' => 'No registration found'], 404);
                }
    
            } else {
                // Referrer does not match the expected host
                return response()->json(['error' => 'Invalid referrer'], 403);
            }
        } else {
            // No referrer set, redirect to cancel URL
            return response()->json(['error' => 'Invalid referrer'], 403);
            // return redirect()->route('cancel_url');
        }
    }
    
    public function cancel_url() {
        $email = auth()->user()->email;
    
        $registration = DailyRegistration::where('email', $email)
            ->where('login_time', '>=', Carbon::now()->subDay())
            ->first();
    
        if ($registration) {
            // Update fields
            $registration->payment_status = 'Pending Cancelled';
            $registration->save();
        }
    
        return response()->json(['cancel' => 'success'], 200);
    }
    

    public function notify_url() {
        // Handle IPN (Instant Payment Notification) from PayFast here
        return response()->json(['status' => 'success'], 200);
    }

    
    function generateApiSignature($pfData, $passPhrase) {

        if ($passPhrase !== null) {
            $pfData['passphrase'] = $passPhrase;
        }

        // Sort the array by key, alphabetically
        ksort($pfData);

        //create parameter string
        $pfParamString = http_build_query($pfData);
        return md5($pfParamString);
    }
}
