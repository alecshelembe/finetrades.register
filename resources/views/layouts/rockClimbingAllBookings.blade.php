@extends('welcome')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Upcoming Events</h1>

        @if ($formattedEvents->isEmpty())
            <p class="text-gray-500">No events found for the next 7 days.</p>
        @else
            <ul class="space-y-6">
                @foreach ($formattedEvents as $event)
                    <li class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-blue-600">{{ $event['title'] }}</h2>
                        <p class="text-gray-700 mt-2">
                            <strong>Start Date:</strong> {{ $event['start_date'] }} <br>
                            <strong>End Date:</strong> {{ $event['end_date'] }}
                        </p>
                        <p class="mt-4">
                            <a href="{{ $event['link'] }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                                View in Google Calendar
                            </a>
                        </p>
                        <p class="mt-4 text-gray-600">
                            <strong>Description:</strong> {{ $event['description'] ?? 'No description available' }}
                        </p>
                        <p class="mt-2 text-gray-600">
                            <strong>Status:</strong> {{ ucfirst($event['status']) }}
                        </p>
                        <hr class="my-4">
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
