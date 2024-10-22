<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PayfastTransaction;
use App\Services\PayfastService;
use App\Models\DailyRegistration; // Ensure this model is imported
use Carbon\Carbon;

class PayfastITNController extends Controller
{
    public function handleITN(Request $request, PayfastService $payfastService)
    {
        // Tell Payfast that this page is reachable by triggering a header 200
        header('HTTP/1.0 200 OK');
        flush();

        // Determine Payfast host (sandbox or live)
        $pfHost = config('payfast.sandbox_mode') ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';

        // Posted variables from ITN
        $pfData = $request->post();

        // Strip any slashes in data
        foreach ($pfData as $key => $val) {
            $pfData[$key] = stripslashes($val);
        }

        // Prepare the parameter string for verification
        $pfParamString = http_build_query(array_diff_key($pfData, ['signature' => '']));

        // Fetch the registration record

        $email = $pfData['email'];

        
        $registration = DailyRegistration::where('email', $email)
        ->where('login_time', '>=', Carbon::now()->subDay())
        ->first();

        // Access the 'amount' column or set a default
        $cartTotal = $registration ? $registration->amount : null;

        // Validate all checks
        $check1 = $payfastService->validSignature($pfData, $pfParamString);
        $check2 = $payfastService->validIP();
        $check3 = $payfastService->validPaymentData($cartTotal, $pfData);
        $check4 = $payfastService->validServerConfirmation($pfParamString, $pfHost);

        if ($check1 && $check2 && $check3 && $check4) {
            // All checks have passed, the payment is successful
            $transactionData = array_intersect_key($pfData, array_flip([
                'm_payment_id', 
                'pf_payment_id' ,  
                'payment_status' , 
                'item_name' ,
                'item_description',  
                'amount_gross' ,
                'amount_fee' ,
                'amount_net'  ,
                'custom_str1'  ,
                'custom_str2'  ,
                'custom_str3'  ,
                'custom_str4'  ,
                'custom_str5'  ,
                'custom_int1'  ,
                'custom_int2'  ,
                'custom_int3'  ,
                'custom_int4'  ,
                'custom_int5'  ,
                'name_first'    ,             
                'email_address'  ,
                'merchant_id'  ,
                'signature'  ,
        ]));

        PayfastTransaction::create($transactionData);


            return response()->json(['status' => 'success']);
        } else {
            $transactionData = array_intersect_key($pfData, array_flip([
                'm_payment_id', 
                'pf_payment_id' ,  
                'payment_status' , 
                'item_name' ,
                'item_description',  
                'amount_gross' ,
                'amount_fee' ,
                'amount_net'  ,
                'custom_str1'  ,
                'custom_str2'  ,
                'custom_str3'  ,
                'custom_str4'  ,
                'custom_str5'  ,
                'custom_int1'  ,
                'custom_int2'  ,
                'custom_int3'  ,
                'custom_int4'  ,
                'custom_int5'  ,
                'name_first'    ,             
                'email_address'  ,
                'merchant_id'  ,
                'signature'  ,
        ]));

        PayfastTransaction::create($transactionData);

            // Some checks have failed, log for investigation
            return response()->json(['status' => 'error', 'message' => 'Payment validation failed'], 400);
        }
    }
}
