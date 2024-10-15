
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
        @if(session('exists'))
            <p class="mx-auto" style="color: orange;"> {!! session('exists') !!}</p>
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
                @if ($post->description != 0)
                    <p>{{ $post->description }}</p>
                @endif
                
                @if ($post->plate === 1)
                    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg mt-10">
                        <img class="h-auto md:w-full" src="{{$post->image_url}}" alt="">
                    </div>    
                    @else
                    {{-- <p>This post is not verified.</p> --}}
                @endif
                <div>
                    <form action={{ route('returnSpeech') }} target="_blank" method="POST">
                        @csrf
                        <textarea name="text" rows="4" style="display: none;" placeholder="Enter text here">{{$post->description}}</textarea>
                        <input type="text" name="audio_id" value="<?php echo(rand());?>" hidden>
                        <button type="submit">Generate Speech <i class=" fa-solid fa-volume-high"></i></button>
                    </form>
                </div>
                <div>
                    <p class="text-sm mt-2">By {{$post->author}}</p>
                    <p class="text-sm">{{$post->created_at}}</p>
                </div>   
            </div>
            @endforeach
    @endif
    
@endsection
