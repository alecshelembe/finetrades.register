@extends('welcome')

@section('content')

@include('layouts.navbar')

<div class="max-w-3xl mx-auto p-2 bg-white rounded-lg">
    {{-- Post Container --}}
    <div class="p-2 bg-white">
    <div>
            {{-- Parse and display images --}}
            @php
                $images = json_decode($Post->images, true); // Decode JSON for a single post
            @endphp

            @if (is_array($images) && count($images) > 0)
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($images as $image)
                        <figure class="max-w-lg relative">
                            <img class="h-auto max-w-full rounded-lg cursor-pointer" 
                                 src="{{ asset($image) }}" 
                                 alt="Post image"
                                 loading="lazy">
                        </figure>
                    @endforeach
                </div>
            @else
                <!-- <p>No images found.</p> -->
            @endif
        </div>

        {{-- Display post description and email --}}
        <p class="text-2xl font-bold">{{ $Post->title }}</p>
        <div class="mt-4">
            <p class="text-gray-700 mb-4">{{ $Post->description }}</p>
            <p class="text-xs text-gray-500">Posted by {{ $Post->author }}</p>
            <p class="text-xs text-gray-500">{{ $Post->formatted_time }}</p>
        </div>
        
        <div class="text-right">
            <a href="https://wa.me/?text={{ urlencode(route('science.view.post', ['id' => $Post->id])) }}" 
                target="_blank" 
                class="p-2 text-sm rounded-full shadow-lg">
                <i class="fa-brands fa-whatsapp"></i> Share
            </a>
        </div>

        {{-- Hide Post Option for the User --}}
        @if (auth()->user()->email === $Post->email)
            <form action="{{ route('science.posts.hide', $Post->id) }}" method="POST">
                @csrf
                <button class="px-2 py-2 text-sm ">
                    <i class="fa-regular fa-eye-slash"></i> Remove my post
                </button>
            </form>
        @endif
       
    </div>
</div>
@endsection