<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        // to specific methods 
        $this->middleware('auth')->only(['home']);
    }

    public function showLoginForm()
    {
        return view('login');  // Assuming your blade is in the "auth" folder
    }

    public function home()
    {
        return view('layouts.home');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:2',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed, redirect to intended page
            return redirect()->route('home'); // Assuming you have a named route 'home'
            // Redirect with a success message
        }

        // Authentication failed, redirect back with error
        return back()->withErrors([
            'failed' => 'The provided credentials do not match our records.',
        ]);

    }

    public function logout(){
        Auth::logout();
        // Redirect with a success message
        return redirect()->route('login')->with('success', 'User logged out successfully!');

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
