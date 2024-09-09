<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the form to create a new user
    public function create()
    {
        // exit("hello world");
        return view('create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'floating_email' => 'required|email|unique:users,email',
            'password' => 'required|min:2',
            'password_confirmation' => 'required|same:password',
            'floating_first_name' => 'required|string|max:255',
            'floating_last_name' => 'required|string|max:255',
            'floating_phone' => 'required|digits:10',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required'
        ]);
    
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
    
        // Store the image in the 'public/images' directory
        $image->storeAs('public/images', $imageName);
    
        // Create the user
        User::create([
            'email' => $validatedData['floating_email'],
            'password' => bcrypt($validatedData['password']),
            'first_name' => $validatedData['floating_first_name'],
            'last_name' => $validatedData['floating_last_name'],
            'phone' => $validatedData['floating_phone'],
            'profile_image_url' => 'images/' . $imageName, // Correctly storing the image path
            'option' => $validatedData['position'],
        ]);
    
        return redirect()->route('users.login')->with('success', 'User created successfully!');
    }
    
}
