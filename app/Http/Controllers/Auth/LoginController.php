<?php 

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\DailyRegistration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function __construct()
    {
        // to specific methods 
        $this->middleware('auth')->only(['home']);
    }

    public function showLoginFormQrCode()
    {
        // Get today's QR code
        $qrCode = \DB::table('qrcodes')
        ->where('expires_at', '>', Carbon::now())
        ->latest('expires_at')
        ->first();

        return view('login', compact('qrCode'));    
    }

    public function showLoginForm()
    {
        return view('login');  // Assuming your blade is in the "auth" folder
    }

    public function home()
    {
        // Fetch data from the 'posts' table
        $posts = \App\Models\Post::all();
    
        // Pass the data to the view
        return view('layouts.home', ['posts' => $posts]);
    }
    
    public function login(Request $request)
    {
        if ($request->has('code')) {
            // The request contains the 'code' field
            $request->validate([
                'code' => 'required|string',
            ]);
            $code_is_present = true;
        }
        // Validate the input for email and password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:2',
        ]);
        
        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {

            $currentDateTime = Carbon::now();

           // Update the updated_at column only
            auth()->user()->touch();
            // Authentication passed, redirect to the intended page
            if (isset($code_is_present)) {
                // Check if the email exists in the past 24 hours
                $exists = DailyRegistration::where('email', auth()->user()->email)
                            ->where('login_time', '>=', Carbon::now()->subDay()) // Past 24 hours
                            ->exists();
            
                if (!$exists) {
                    // Record the login in the daily registration table
                    DailyRegistration::create([
                        'email' => auth()->user()->email,
                        'login_time' => now(),
                    ]);

                    $exists = "Register log @ ".$currentDateTime. ' Successful';
                    
                    return redirect()->route('home')->with('exists', $exists);

                } else {
                    // Handle the case where the email has already been recorded in the last 24 hours
                    // For example, you could return an error message
                    $exists = "Register log already exists.";

                    return redirect()->route('home')->with('exists', $exists);
                }
            }

            // Get the current date
            $today = Carbon::today();

            // Check if the user has logged in today
            $exists = DailyRegistration::where('email', auth()->id())
                ->whereDate('created_at', $today)
                ->exists();
            if (!$exists) {
                $exists = '<a href="' . route('login.qrcode') . '" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded bg-gray-100 hover:bg-blue-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                <!-- Plus icon -->
                               Daily Register
                            </a>';
            } else {
                
                $exists = "";
            }
            
            return redirect()->route('home')->with('exists', $exists); // Redirect to 'home' route with $exists

        } 
    
        // Authentication failed, redirect back with an error
        return back()->withErrors([
            'failed' => 'The provided credentials do not match our records.',
        ]);
    }
    

    public function logout(){
        Auth::logout();
        // Redirect with a success message
        return redirect()->route('login')->with('success', 'User logged out successfully!');

    }


    public function qrLogin(Request $request)
    {
        // Validate the input (expecting a 'code' field from the scanned QR code)
        $request->validate([
            'code' => 'required|string',
        ]);
        
        // Check if the code matches today's QR code
        $qrCode = \DB::table('qrcodes')
        ->where('code', $request->code)
        ->where('expires_at', '>', Carbon::now())
        ->first();
        
        $currentDateTime = Carbon::now();
        
        if ($qrCode) {

            $code = $qrCode->code;
            $correct_qrcode = "Register log @ ".$currentDateTime. ' Please continue';
            return view('login')->with(compact('code', 'correct_qrcode'));

            // Record the login in the daily registration table
            \DB::table('daily_registration')->insert([
                'user_id' => auth()->id(),
                'login_time' => now(),
            ]);

        } else {
            // return back()->withErrors(['code' => 'Invalid or expired QR code.']);
            $incorrect_qrcode = "Error log @ ".$currentDateTime;
            return view('login')->with('incorrect_qrcode', $incorrect_qrcode);

        }
    }
}



// // Public route
// Route::get('/', function () {
//     return view('welcome');  // This is accessible by everyone
// });

// // Protected routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');  // Only authenticated users can access this
//     });

//     Route::get('/profile', function () {
//         return view('profile');  // Only authenticated users can access this
//     });
// });
