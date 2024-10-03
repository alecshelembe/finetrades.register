<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    // index(): List available climbing sessions.
    // store(): Allow users to make a booking.
    // show(): Show user-specific bookings.
    // update(): Modify an existing booking (e.g., reschedule).
    // destroy(): Cancel a booking.
    // Apply the auth middleware to all methods in this controller
    public function __construct()
    {
        $this->middleware('auth');
        // to specific methods 
        // $this->middleware('auth')->only(['create', 'store']);
    }

    public function index(){

    }
    public function store(){

    }   
    public function show(){

    }
    public function update(){

    }
    public function destroy(){

    }
}
