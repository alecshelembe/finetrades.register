<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Log;
use App\Models\SocialPost;
use App\Models\Post;
use Carbon\Carbon;


class CreateController extends Controller
{
    // Apply the auth middleware to all methods in this controller
    public function __construct()
    {
        $this->middleware('auth');
        // to specific methods 
        // $this->middleware('auth')->only(['create', 'store']);
    }

    public function showPostForm()
    {
        return view('ocr_result');
    }

    public function showMobilePostForm()
    {
        return view('mobile.create');
    }
    
    public function viewSocialPosts()
    {
            // Fetch all social posts with status 'show'
            $socialPosts = SocialPost::where('status', 'show')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Convert the timestamps to a readable format
        foreach ($socialPosts as $post) {
            $post->formatted_time = Carbon::parse($post->created_at)->diffForHumans();
            $emailParts = explode('@', $post->email); // Assuming you have an 'email' column
            $post->author = $emailParts[0]; // Get the part before the '@'
            $post->email = $post->email;// Get the part before the '@'
        }

        // Pass posts to the view
        return view('mobile.home', compact('socialPosts'));
    }

    public function sciencePosts()
    {
        // Fetch data from the 'posts' table
        $posts = Post::where('status', 'show')
        ->orderBy('created_at', 'desc')
        ->get();

        foreach ($posts as $post) {
            $post->formatted_time = Carbon::parse($post->created_at)->diffForHumans();
            // Extract the author's name from the email
            $post->email = $post->author; // Get the part before the '@'
            $emailParts = explode('@', $post->author); // Assuming you have an 'email' column
            $post->author = $emailParts[0]; // Get the part before the '@'
        }
    
        // Pass the data to the view
        return view('layouts.science', ['posts' => $posts]);

    }

    public function scienceHide($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);
        
        // Check if the logged-in user's author matches the post's email
        if (auth()->user()->email === $post->author) {
            // Update the status to 'hide' (or however you want to handle hiding)
            $post->status = 'hide';
            $post->save();
            
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Post hidden successfully.');
        }

        // Redirect back with an error message if the user doesn't match
        return redirect()->back()->with('error', 'You are not authorized to hide this post.');
    }

    public function hide($id)
    {
        // Find the post by ID
        $post = SocialPost::findOrFail($id);
        
        // Check if the logged-in user's email matches the post's email
        if (auth()->user()->email === $post->email) {
            // Update the status to 'hide' (or however you want to handle hiding)
            $post->status = 'hide';
            $post->save();
            
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Post hidden successfully.');
        }

        // Redirect back with an error message if the user doesn't match
        return redirect()->back()->with('error', 'You are not authorized to hide this post.');
    }


    public function saveSocialPost(Request $request)
    {
        // Validate inputs
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:255',
        ]);
    
        $imagePaths = [];
    
        // Handle each image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file) {
                    $imageName = time() . '_' . $file->getClientOriginalName();
                    // Save the image in storage/app/public/images/social/
                    $file->storeAs('public/images/social/', $imageName);
                    // Update image path to be stored in the database
                    $imagePath = 'storage/images/social/' . $imageName; // Use 'storage' here for generating public-facing URL
                    $imagePaths[] = $imagePath;
                }
            }
        }
    
        // Save the description and image paths to the database
        SocialPost::create([
            'description' => $request->description,
            'images' => json_encode($imagePaths),
            'email' => auth()->user()->email, // Get the logged-in user's email
        ]);
    
        return redirect()->route('home')->with([
            'success' => 'Post Created Successfully'
        ]);
    }
    

    public function savePost(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:10240',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        // Handle image upload if provided
        $imagePath = 'images/default-profile.png'; // Default image path
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // Save the image in storage/app/public/images
            $image->storeAs('public/images/uploaded/', $imageName);
            // Update image path to be stored in the database
            $imagePath = 'storage/images/uploaded/' . $imageName; // Use 'storage' here for generating public-facing URL
        }
        
        $post = Post::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image_url' => $imagePath,
            'author' => auth()->user()->email, // Add the logged-in user's email
        ]);

        return redirect()->route('home')->with([
            'success' => 'Post Created Successfully'
        ]);
        
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

        $imagePath = $request->file('image')->store('public/images/demo-images');

        // Run OCR
        try {
            $text = (new TesseractOCR(storage_path('app/' . $imagePath)))
                ->lang('eng')
                ->run();
            
                return redirect()->route('create.raw.post', ['text' => $text]);

        } catch (\Exception $e) {
            Log::error('OCR processing failed: ' . $e->getMessage());
            return redirect()->route('create.post')->with([
                'failed' => 'An error occurred while processing the image.!'
            ]);
        }
    }
}