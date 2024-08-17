<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Method to fetch all posts
    public function index()
    {
        // Fetch all posts from the database
        $posts = Post::all();

        // Return a view with the posts data
        return view('posts.index', ['posts' => $posts]);
    }

    // Method to fetch a single post by ID
    public function show($id)
    {
        // Fetch a post by its ID
        $post = Post::findOrFail($id);

        // Return a view with the post data
        return view('posts.show', ['post' => $post]);
    }
}
