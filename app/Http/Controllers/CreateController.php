<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Log;
use App\Models\Post;

class CreateController extends Controller
{
    // Apply the auth middleware to all methods in this controller
    public function __construct()
    {
        $this->middleware('auth');
        // to specific methods 
        // $this->middleware('auth')->only(['create', 'store']);
    }

    public function showPost()
    {
        return view('ocr_result');
    }

    public function savePost(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        
        // Handle image upload if provided
        $imagePath = 'images/default-profile.png'; // Default image path
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Save the image in storage/app/public/images
            $image->storeAs('public/images', $imageName);
            // Update image path to be stored in the database
            $imagePath = 'storage/images/' . $imageName; // Use 'storage' here for generating public-facing URL
        }
        
        $post = Post::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image_url' => $imagePath,
            'author' => auth()->user()->email, // Add the logged-in user's email
        ]);

        exit("Upload Successful");
        
    }

    public function create()
    {
        return view('layouts.create');
    }

    public function processImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $imagePath = $request->file('image')->store('public/images');

        // Run OCR
        try {
            $text = (new TesseractOCR(storage_path('app/' . $imagePath)))
                ->lang('eng')
                ->run();

            return view('ocr_result', ['text' => $text]);

        } catch (\Exception $e) {
            Log::error('OCR processing failed: ' . $e->getMessage());
            return back()->withErrors('An error occurred while processing the image.');
        }
    }
}
