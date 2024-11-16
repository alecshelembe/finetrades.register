@extends('welcome')

@section('content')
@include('layouts.navbar')

<style>
    img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }
</style>

@if($posts->isEmpty() && $socialPosts->isEmpty())
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5>No Posts here..</h5>
    </div>
@else
    @php
        // Merge and sort posts by date
        $allPosts = $posts->merge($socialPosts)->sortByDesc('created_at');
    @endphp

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-4">
        @foreach ($allPosts as $post)
            <div class="bg-white p-4 rounded-lg shadow">
                {{-- Check if the post is a science post --}}
                @if (isset($post->title))
                    <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-sm {{ $post->verified ? 'text-green-600' : 'text-red-600' }}">
                        <i class="fa {{ $post->verified ? 'fa-circle-check' : 'fa-circle-question' }}"></i>
                        {{ $post->verified ? 'Verified' : 'Not Verified' }}
                    </p>
                    @if ($post->description)
                        <p class="mt-2">{{ $post->description }}</p>
                    @endif
                    @if ($post->plate === 1)
                        <img class="mt-4 h-auto w-full rounded" src="{{ $post->image_url }}" alt="">
                    @endif
                    <form action="{{ route('returnSpeech') }}" target="_blank" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="text" value="{{ $post->description }}">
                        <input type="hidden" name="audio_id" value="{{ rand() }}">
                        <button type="submit" class="text-blue-800">Generate Speech <i class="fa-solid fa-volume-high"></i></button>
                    </form>
                @else
                    {{-- Social Post --}}
                    @php
                        $images = json_decode($post->images, true);
                    @endphp
                    @if (is_array($images) && count($images) > 0)
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            @foreach ($images as $image)
                                <img class="h-auto w-full rounded" src="{{ asset($image) }}" alt="Post image" loading="lazy">
                            @endforeach
                        </div>
                    @else
                        <p>No images found.</p>
                    @endif
                    <p class="text-sm text-gray-700">{{ $post->description }}</p>
                @endif

                {{-- Common fields for both post types --}}
                <p class="text-xs text-gray-500">Posted by: {{ $post->author }} - {{ $post->formatted_time }}</p>
                @if (auth()->user()->email === $post->email)
                    <form action="{{ isset($post->title) ? route('science.posts.hide', $post->id) : route('posts.hide', $post->id) }}" method="POST">
                        @csrf
                        <button class="px-2 text-xs py-2 text-blue-800"><i class="fa-regular fa-eye"></i> Hide my post</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endif

@endsection
