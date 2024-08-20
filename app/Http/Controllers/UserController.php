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
        dd($request->all());

        exit();
        $validatedData = $request->validate([
            'floating_email' => 'required|email|unique:users,email',
            'password' => 'required|min:2',
            'password_confirmation' => 'required|same:password',
            'floating_first_name' => 'required|string|max:255',
            'floating_last_name' => 'required|string|max:255',
            'floating_phone' => 'required|digits:10',
            'position' => 'required'
        ]);

        // Create the user
        User::create([
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'],
            'option' => $validatedData['option'],
        ]);
        // return redirect()->back()->with('success', 'Form submitted successfully!');

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}