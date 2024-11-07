@extends('welcome')

@section('content')
@include('layouts.navbar')

<style>
    /* Target all images within the post container */
     img {
        max-width: 80%; /* Set a maximum width for desktop */
        height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Ensure images cover the space without distortion */
    }

    @media (min-width: 768px) {
         img {
            max-width: auto; /* Adjust maximum width for larger screens */
        }
    }

    @media (min-width: 1024px) {
         img {
            max-width: auto; /* Further reduce maximum width for even larger screens */
        }
    }
</style>


@if($posts->isEmpty() && $socialPosts->isEmpty())
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5>No Posts here..</h5>
    </div>
@else
    @php
        $postCount = 0;
        $socialPostCount = 0;
        $maxCount = max($posts->count(), $socialPosts->count());
    @endphp

    <div class="flex flex-col gap-6">
        @for ($i = 0; $i < $maxCount; $i++)
            {{-- Science Post --}}
            @if ($postCount < $posts->count())
                <div class="bg-white ">
                    <h3 class="text-2xl font-bold mb-2">{{ $posts[$postCount]->title }}</h3>
                    <p class="text-sm {{ $posts[$postCount]->verified ? 'text-green-600' : 'text-red-600' }}">
                        <i class="fa {{ $posts[$postCount]->verified ? 'fa-circle-check' : 'fa-circle-question' }}"></i>
                        {{ $posts[$postCount]->verified ? 'Verified' : 'Not Verified' }}
                    </p>
                    @if ($posts[$postCount]->description)
                        <p class="mt-2">{{ $posts[$postCount]->description }}</p>
                    @endif
                    @if ($posts[$postCount]->plate === 1)
                        <img class="mt-4 h-auto w-full rounded" src="{{ $posts[$postCount]->image_url }}" alt="">
                    @endif
                    <form action="{{ route('returnSpeech') }}" target="_blank" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="text" value="{{ $posts[$postCount]->description }}">
                        <input type="hidden" name="audio_id" value="{{ rand() }}">
                        <button type="submit" class="text-blue-800">Generate Speech <i class="fa-solid fa-volume-high"></i></button>
                    </form>
                    <p class="text-sm mt-2 text-gray-600">By {{ $posts[$postCount]->author }} - {{ $posts[$postCount]->formatted_time }}</p>
                    @if (auth()->user()->email === $posts[$postCount]->email)
                        <form action="{{ route('science.posts.hide', $posts[$postCount]->id) }}" method="POST">
                            @csrf
                            <button class="px-2 text-xs py-2 text-blue-800"><i class="fa-regular fa-eye"></i> Hide my post</button>
                        </form>
                    @endif
                </div>
                @php $postCount++; @endphp
            @endif

            {{-- Social Post --}}
            @if ($socialPostCount < $socialPosts->count())
                <div class="bg-white ">
                    @php
                        $images = json_decode($socialPosts[$socialPostCount]->images, true);
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
                    <p class="text-sm text-gray-700">{{ $socialPosts[$socialPostCount]->description }}</p>
                    <p class="text-xs text-gray-500">Posted by: {{ $socialPosts[$socialPostCount]->author }} - {{ $socialPosts[$socialPostCount]->formatted_time }}</p>
                    @if (auth()->user()->email === $socialPosts[$socialPostCount]->email)
                        <form action="{{ route('posts.hide', $socialPosts[$socialPostCount]->id) }}" method="POST">
                            @csrf
                            <button class="px-2 text-xs py-2 text-blue-800"><i class="fa-regular fa-eye"></i> Hide my post</button>
                        </form>
                    @endif
                </div>
                @php $socialPostCount++; @endphp
            @endif
        @endfor
    </div>
@endif

@endsection

<style>
    /* Default small image size */
    #postContainer img {
        max-width: 200px; /* Set a maximum width for small images */
        height: auto; /* Maintain aspect ratio */
        object-fit: cover; /* Ensure images cover the space without distortion */
    }

    /* Class for large images */
    .large-image {
        max-width: 500px; /* Set a maximum width for large images */
    }
</style>



