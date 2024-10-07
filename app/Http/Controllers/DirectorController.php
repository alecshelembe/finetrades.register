<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function rocks()
    {
        return view('layouts.events.rockclimbing');
    }

}
