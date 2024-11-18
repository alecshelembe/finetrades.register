@extends('welcome')

@section('content')
@include('layouts.navbar')

<div class="max-w-3xl mx-auto p-2 bg-white rounded-lg">
    {{-- Post Container --}}
    <div class="p-2 bg-white">
        <div>
            {{-- Parse and display images --}}
            @php
                $images = json_decode($socialPost->images, true); // Decode JSON for a single post
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
                <p>No images found.</p>
            @endif
        </div>

        {{-- Display post description and email --}}
        <div class="mt-4">
            <p class="text-sm text-gray-700">{{ $socialPost->description }}</p>
            <p class="text-xs text-gray-500">Posted by: {{ $socialPost->author }}</p>
            <p class="text-xs text-gray-500">{{ $socialPost->formatted_time }}</p>
            

            {{-- Toggle post visibility if user is the author --}}
            @if (auth()->user()->email === $socialPost->email)
                @if ($socialPost->status === 'show')
                    <form action="{{ route('posts.hide', $socialPost->id) }}" method="POST">
                        @csrf
                        <button class="px-2 text-sm py-2"><i class="fa-regular fa-eye-slash"></i> Hide my post</button>
                    </form>
                @else
                    <form action="{{ route('posts.show', $socialPost->id) }}" method="POST">
                        @csrf
                        <button class="px-2 text-sm py-2"><i class="fa-regular fa-eye"></i> Show my post</button>
                    </form>
                @endif
                <div class="text-right">
                    <a href="https://wa.me/?text={{ urlencode(route('social.view.post', ['id' => $socialPost->id])) }}" 
                        target="_blank" 
                        class="p-2 text-sm rounded-full shadow-lg">
                        <i class="fa-brands fa-whatsapp"></i> Share
                    </a>
                </div>
                <form action="#" method="POST">
                    @csrf
                    <button class="p-2 text-sm rounded-full shadow-lg">
                            <i class="fa-regular fa-comment"></i> Leave a comment
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
