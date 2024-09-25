
@extends('welcome')

@section('content')

<section>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"> Development</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    </nav>
</section>

@if($posts->isEmpty())
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5>No Posts here..</h5>
        </div>
    @else
        @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif
            @foreach($posts as $post)
            <div class="m-4">
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
<div class="fixed bottom-4 right-4 m-4">
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
</div>


@endsection
