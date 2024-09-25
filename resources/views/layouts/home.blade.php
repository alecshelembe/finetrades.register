
@extends('welcome')

@section('content')
  
@include('layouts.navbar')
@if($posts->isEmpty())
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5>No Posts here..</h5>
        </div>
    @else
        @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif
            @foreach($posts as $post)
            <div>
                {{-- <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{$post->image_url}}" alt=""> --}}
                <h3 class="text-bold text-2xl mb-2">{{$post->title}}</h3>
                @if ($post->verified === 1)
                    <p class="text-sm mt-2"><i class="fa-solid fa-circle-check"></i> Verified</p>
                    {{-- <p class="text-sm mt-2"><i class="fa-solid fa-circle-check"></i> {{$post->author}}</p> --}}
                    @else
                    <p class="text-sm mt-2"><i class="fa-regular fa-circle-question"></i> Not Verified </p>
                @endif
                <p>{{$post->description}}</p>
                <p class="text-sm mt-2">By {{$post->author}}</p>
                <p class="text-sm">{{$post->created_at}}</p>

                @if ($post->plate === 1)
                <img class="h-auto md:w-full" src="{{$post->image_url}}" alt="">
                    
                @else
                    {{-- <p>This post is not verified.</p> --}}
                @endif
                
            </div>
            @endforeach
    @endif

<!-- Blade Template Button -->
{{-- <div class="fixed bottom-4 right-4 m-4">
    <a href="{{ route('create.post') }}" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
        <!-- Plus icon -->
       <span class="text-lg">Create</span>
    </a>
</div>


<div class="fixed bottom-4 left-4 m-4">
    <a href="{{ route('users.logout') }}" class="bg-blue-500 p-4 text-white rounded-full shadow-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
        <!-- Plus icon -->
        Go Offline
    </a>
</div> --}}


@endsection
