<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // Assuming your blade is in the "auth" folder
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
            // return redirect()->intended('/');
            exit("hello world");
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
        return redirect()->route('users.login')->with('success', 'User logged out successfully!');

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
