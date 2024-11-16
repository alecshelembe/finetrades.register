@extends('welcome')

@section('content')

@include('layouts.navbar')  

@if($posts->isEmpty())
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5>No Posts here..</h5>
    </div>
@else
    {{-- Grid Layout for Posts --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($posts as $post)
            <div class="bg-white p-4 rounded-lg shadow-lg">
                {{-- Post Title --}}
                <h3 class="text-bold text-2xl mb-2">{{$post->title}}</h3>
                
                {{-- Verification Status --}}
                @if ($post->verified === 1)
                    <p class="text-sm mt-2"><i class="fa-solid fa-circle-check"></i> Verified</p>
                @else
                    <p class="text-sm mt-2"><i class="fa-regular fa-circle-question"></i> Not Verified </p>
                @endif
                
                {{-- Post Description --}}
                @if ($post->description != 0)
                    <p class="mt-2">{{ $post->description }}</p>
                @endif
                
                {{-- Post Image --}}
                @if ($post->plate === 1)
                    <div class="mt-4">
                        <img loading="lazy" class="h-auto w-full rounded-lg" src="{{$post->image_url}}" alt="">
                    </div>    
                @endif
                
                {{-- Speech Generation Form --}}
                <div class="mt-4">
                    <form action="{{ route('returnSpeech') }}" target="_blank" method="POST">
                        @csrf
                        <textarea name="text" rows="4" style="display: none;" placeholder="Enter text here">{{$post->description}}</textarea>
                        <input type="text" name="audio_id" value="{{ rand() }}" hidden>
                        <button type="submit" class="px-4 py-2 ">
                            Generate Speech <i class="fa-solid fa-volume-high"></i>
                        </button>
                    </form>
                </div>

                {{-- Post Author and Time --}}
                <div class="mt-4 text-sm text-gray-500">
                    <p>By {{$post->author}}</p>
                    <p>{{ $post->formatted_time }}</p>
                </div>

                {{-- Hide Post Option for the User --}}
                @if (auth()->user()->email === $post->email)
                    <form action="{{ route('science.posts.hide', $post->id) }}" method="POST">
                        @csrf
                        <button class="px-2 text-sm py-2">
                            <i class="fa-regular fa-eye-slash"></i> Hide my post
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
@endif

@endsection
