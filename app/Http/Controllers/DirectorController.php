<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function rockClimbing()
    {
        return view('layouts.events.rockclimbing');
    }
    public function sciencePosts()
    {
        // Fetch data from the 'posts' table
        $posts = \App\Models\Post::all();

        foreach ($posts as $post) {
            $post->formatted_time = \Carbon\Carbon::parse($post->created_at)->format('F d, Y \a\t h:i A');
            // Extract the author's name from the email
            $emailParts = explode('@', $post->author); // Assuming you have an 'email' column
            $post->author = $emailParts[0]; // Get the part before the '@'
        }
    
        // Pass the data to the view
        return view('layouts.science', ['posts' => $posts]);

    }
    public function venueHire()
    {
        return view('layouts.events.venuehire');
    }
    public function showImages()
    {
        // Get all files in the specified directory
        $images = Storage::files('public/images/gallery'); // Adjust the path as needed
        $images = array_map(fn($path) => str_replace('public/', 'storage/', $path), $images);

        return view('layouts.events.guidedtour', compact('images'));
    }

}
