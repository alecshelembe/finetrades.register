@extends('welcome')

@section('content')
@include('layouts.navbar')

<div class="max-w-3xl mx-auto p-2 bg-white rounded-lg">
    {{-- Post Container --}}
    <div class="p-2 bg-white">

        {{-- Display post description and email --}}
        <p class="text-2xl font-bold">{{ $Post->title }}</p>
        <div class="mt-4">
            <p class="text-sm text-gray-700 mb-4">{{ $Post->description }}</p>
            <p class="text-xs text-gray-500">Posted by {{ $Post->author }}</p>
            <p class="text-xs text-gray-500">{{ $Post->formatted_time }}</p>
        </div>
       
    </div>
</div>
@endsection
