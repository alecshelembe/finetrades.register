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
        // dd($request->all()); // This will dump all the request data
        // Validate the request data
        $validatedData = $request->validate([
            'floating_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', // More secure length for passwords
            'password_confirmation' => 'required|same:password',
            'google_location' => 'nullable|string|max:255',
            'google_latitude' => 'nullable|string|max:255',
            'google_longitude' => 'nullable|string|max:255',
            'google_location_type' => 'nullable|string|max:255',
            'google_postal_code' => 'nullable|string|max:255',
            'google_city' => 'nullable|string|max:255',
            'package_selected' => 'nullable|string|max:255',
            'web_source' => 'nullable|string|max:255',
            'location_id' => 'nullable|string|max:255',
            'floating_first_name' => 'required|string|max:255',
            'floating_last_name' => 'required|string|max:255',
            'floating_phone' => 'required|digits:10', // This matches the South African phone number format you specified earlier
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255',
        ]);

        // Handling image upload if provided
        $imagePath = 'images/default-profile.png'; // Default image path
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);
            $imagePath = 'images/' . $imageName;
        }

        // Create the user with the validated data
        $user = User::create([
            'email' => $validatedData['floating_email'],
            'password' => Hash::make($validatedData['password']), // Hash the password securely
            'google_location' => $validatedData['google_location'] ?? '',
            'google_latitude' => $validatedData['google_latitude'] ?? '',
            'google_longitude' => $validatedData['google_longitude'] ?? '',
            'google_location_type' => $validatedData['google_location_type'] ?? '',
            'google_postal_code' => $validatedData['google_postal_code'] ?? '',
            'google_city' => $validatedData['google_city'] ?? '',
            'package_selected' => $validatedData['package_selected'] ?? '',
            'web_source' => $validatedData['web_source'] ?? '',
            'location_id' => $validatedData['location_id'] ?? '',
            'first_name' => $validatedData['floating_first_name'],
            'last_name' => $validatedData['floating_last_name'],
            'phone' => $validatedData['floating_phone'],
            'profile_image_url' => $imagePath, // Store the uploaded or default image path
            'position' => $validatedData['position'],
        ]);

        // Redirect with a success message
        return redirect()->route('users.login')->with('success', 'User created successfully!');
    }
    
}
