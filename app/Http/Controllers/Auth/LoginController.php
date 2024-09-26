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

        return view('layouts.QrCodeRegister', compact('qrCode'));    
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
            // The request contains the 'email' field
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
            // Authentication passed, redirect to the intended page
            if (isset($code_is_present)) {
                // Record the login in the daily registration table
                DailyRegistration::create([
                    'email' => auth()->user()->email,
                    'login_time' => now(),
                ]);
            }
            
            
            return redirect()->route('home'); // Assuming you have a named route 'home'
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
        
        if ($qrCode) {

            $code = $qrCode->code;
            $correct_qrcode = "Correct Qrcode";
            return view('login')->with(compact('code', 'correct_qrcode'));

            // Record the login in the daily registration table
            \DB::table('daily_registration')->insert([
                'user_id' => auth()->id(),
                'login_time' => now(),
            ]);

        } else {
            // return back()->withErrors(['code' => 'Invalid or expired QR code.']);
            $incorrect_qrcode = "Incorrect Qrcode";
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
