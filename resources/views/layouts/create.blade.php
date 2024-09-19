
@extends('welcome')

@section('content')

<!-- Blade Template Button -->

<div class="max-w-3xl mx-auto p-6 bg-white  rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Create a New Post</h1>
    
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the title" required>
        </div>
        
        <!-- Image Upload -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Image</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description" required></textarea>
        </div>
        
        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Submit
            </button>
        </div>
    </form>
</div>

@endsection
