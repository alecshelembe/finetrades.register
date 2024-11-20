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
            <p class="text-gray-700">{{ $socialPost->description }}</p>
            <p class="text-xs text-gray-500">Posted by {{ $socialPost->author }}</p>
            <p class="text-xs text-gray-500">{{ $socialPost->formatted_time }}</p>

            {{-- Toggle post visibility if user is the author --}}
            @if (auth()->user()->email === $socialPost->email)
                @if ($socialPost->status === 'show')
                    <form action="{{ route('posts.hide', $socialPost->id) }}" method="POST">
                        @csrf
                        <button class=" rounded-full shadow-lg px-2 text-sm py-2"><i class="fa-regular fa-eye-slash"></i> Hide my post</button>
                    </form>
                @else
                    <form action="{{ route('posts.show', $socialPost->id) }}" method="POST">
                        @csrf
                        <button class="rounded-full shadow-lg px-2 text-sm py-2"><i class="fa-regular fa-eye"></i> Show my post</button>
                    </form>
                @endif
                <div class="text-right">
                    <a href="https://wa.me/?text={{ urlencode(route('social.view.post', ['id' => $socialPost->id])) }}" 
                        target="_blank" 
                        class="p-2 text-sm rounded-full shadow-lg">
                        <i class="fa-brands fa-whatsapp"></i> Share
                    </a>
                </div>

            @endif
        </div>

        {{-- Comments Section --}}
        <div class="mt-4">
            <h3 class=" text-sm ">Comments:</h3><span  class=" text-sm ">*NB Only the author can remove comments<span>

            {{-- Check if comments are not null and not empty --}}
            @if ($socialPost->comments && count($socialPost->comments) > 0)
                @foreach ($socialPost->comments as $comment)
                <div>
                    {{-- Extract the author from the email part before '@' --}}
                    @php
                        $emailParts = explode('@', $comment['author']);
                        $author = $emailParts[0];  // Get the part before the '@'
                    @endphp

                    <p><strong>{{ $author }}</strong> {{ $comment['content'] }}</p>
                    <p class="text-xs text-gray-500">
                        Posted {{ \Carbon\Carbon::parse($comment['created_at'])->diffForHumans() }}
                    </p>
                    @if (auth()->user()->email === $socialPost->email)
                        <form class="text-right mt-4" action="{{ route('comments.clear', [$socialPost->id]) }}" method="POST">
                            <input type="text" class="hidden" name="comment_id" value="{{ ($comment['id']) }}"/>
                            @csrf
                            <button type="submit" class="p-2 text-sm rounded-full shadow-lg">  <i class="fa-solid fa-xmark"></i> Clear </button>
                        </form>
                    @endif
                </div>
                @endforeach
            @else
                <p>Be the first to leave a comment.</p>
            @endif

            {{-- Comment form --}}
            <form action="{{ route('comments.store', $socialPost->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-2">
                    <textarea name="content" placeholder="Your comment" class="w-full p-2 border rounded" required></textarea>
                </div>
                @error('content')
                    <p class="text-red-600  mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="p-2 text-sm rounded-full shadow-lg">  <i class="fa-regular fa-comment"></i> Post my comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
