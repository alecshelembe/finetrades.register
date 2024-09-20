
@extends('welcome')

@section('content')

<div class="grid mb-8 d md:mb-12 md:grid-cols-2 bg-white dark:bg-gray-800">

@if($posts->isEmpty())
        <p class=" text-2xl text-bold">No posts found.</p>
    @else
        <ul>
            @foreach($posts as $post)
            <figure class="flex flex-col items-center justify-center p-8 text-center bg-white rounded-t-lg md:rounded-none md:border dark:bg-gray-800 dark:border-gray-700">
                <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="{{$post->image_url}}" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$post->title}}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$post->description}}</p>
                        <p class="font-normal text-gray-700 dark:text-gray-400">{{$post->author}}</p>
                        <p class="font-normal text-gray-700 dark:text-gray-400">{{$post->created_at}}</p>
                    </div>
                </a>
            </figure>
            @endforeach
        </ul>
    @endif
 
</div> 

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
