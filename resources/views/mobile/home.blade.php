@extends('welcome')

@section('content')
@include('layouts.navbar')

<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg ">
    <div class="flex justify-end">
        <button id="toggleView" class="px-4 py-2 text-white bg-blue-500 rounded-lg">Toggle View</button>
    </div>
    
    <div id="postContainer" class="grid grid-cols-2 gap-4 mt-4">
        @foreach ($socialPosts as $post)
            <div class="p-2  bg-white">
                <div class="grid grid-cols-2 gap-4">
                    {{-- Parse and display images --}}
                    @php
                        $images = json_decode($post->images, true); // Decode JSON
                    @endphp
    
                    @if (is_array($images) && count($images) > 0)
                        @foreach ($images as $image)
                            <figure class="max-w-lg relative">
                                <img class="h-auto max-w-full rounded-lg cursor-pointer" 
                                     src="{{ asset($image) }}" 
                                     alt="Post image">
                            </figure>
                        @endforeach
                    @else
                        <p>No images found.</p>
                    @endif
                </div>
    
                {{-- Display post description and email --}}
                <div class="mt-4">
                    <p class="text-sm text-gray-700">{{ $post->description }}</p>
                    <p class="text-xs text-gray-500">Posted by: {{ $post->email }}</p>
                    {{-- <p class="text-xs text-gray-500">{{ $post->created_at }}</p> --}}
                </div>
            </div>
        @endforeach
    </div>
    
    <script>
        const toggleButton = document.getElementById('toggleView');
        const postContainer = document.getElementById('postContainer');
        
        let isGrid = true;
        
        toggleButton.addEventListener('click', function() {
            if (isGrid) {
                postContainer.classList.remove('grid', 'grid-cols-2');
                postContainer.classList.add('flex', 'flex-col');
            } else {
                postContainer.classList.remove('flex', 'flex-col');
                postContainer.classList.add('grid', 'grid-cols-2');
            }
            isGrid = !isGrid;
        });
    </script>
    
</div>
@endsection