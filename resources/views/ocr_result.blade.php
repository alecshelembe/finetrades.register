@extends('welcome')

@section('content')

<script defer src="{{ asset('js/jq_app.js') }}"></script>
<script defer src="{{ asset('js/app.js') }}"></script>
<!-- Blade Template Button -->

<div class="max-w-3xl mx-auto p-6 bg-white  rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Create a New Post</h1>

    <form action="{{ route('save.raw.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Title -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter the title" >
            @error('title')
            <p class="text-red-600  mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Image Upload -->
        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image Post</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            @error('image')
            <p class="text-red-600  mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Enter a description" >{{ old('text', request()->query('text')) }}
            </textarea>
            @error('description')
            <p class="text-red-600  mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- <script>
            CKEDITOR.replace('ClassicEditor');
        </script> --}}
        <div>
            <img id="image-preview" 
            src="" 
            name="image" 
            alt="Image Preview"  
            style="width: 150px; height: 150px; border-radius: 50%;" 
            class="mx-auto hidden object-cover shadow-md" />
        </div>
        
        
        <!-- Submit Button -->
        <div class="text-right">
            <button type="submit" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Save
            </button>
        </div>
    </form>
</div>

@endsection