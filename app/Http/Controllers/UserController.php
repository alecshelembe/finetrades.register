<?php

namespace App\Http\Controllers;

use App\Mail\SignUpMail; // Correctly import the SignUpMail class
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected function sendEmail(array $validatedData)
    {
        $data = ['name' => $validatedData['floating_first_name']];
        
        Mail::to($validatedData['floating_email'])->send(new SignUpMail($data));
    }

    // Show the form to create a new user
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'floating_email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'google_location' => 'nullable|string|max:255',
            'floating_address' => 'nullable|string|max:255',
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
            'floating_phone' => 'required|digits:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'position' => 'required|string|max:255',
        ]);

        // Handle image upload if provided
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
            'password' => Hash::make($validatedData['password']),
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
            'profile_image_url' => $imagePath,
            'position' => $validatedData['position'],
        ]);

        // Call the sendEmail function with necessary data
        $this->sendEmail($validatedData);

        // Redirect with a success message and email
        return redirect()->route('login')->with([
            'success' => 'User created successfully!',
            'email' => $user->email,
            'profile_image_url' => $user->profile_image_url
        ]);
    }
}
