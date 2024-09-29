
@extends('welcome')

@section('content')
    <h1>Upcoming Events</h1>

    @if ($formattedEvents->isEmpty())
        <p>No events found for the next 7 days.</p>
    @else
        <ul>
            @foreach ($formattedEvents as $event)
                <li>
                    <strong>{{ $event['title'] }}</strong> <br>
                    Start Date: {{ $event['start_date'] }} <br>
                    End Date: {{ $event['end_date'] }} <br>
                    <a href="{{ $event['link'] }}" target="_blank">View in Google Calendar</a>
                    <br>
                    Description: {{ $event['description'] ?? 'No description available' }} <br>
                    Status: {{ ucfirst($event['status']) }}
                    <hr>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
