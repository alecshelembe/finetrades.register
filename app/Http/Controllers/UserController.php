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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:2',
            'repeat_password' => 'required|same:password',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'option' => 'required'
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

        return redirect()->route('users.create')->with('success', 'User created successfully!');
    }
}