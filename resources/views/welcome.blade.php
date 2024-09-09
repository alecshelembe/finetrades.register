<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Laravel</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css"> --}}
        <link rel="stylesheet" href="{{ asset('css/output.css') }}">
        
    </head>
    <body>
        {{-- <div id="map" style="height: 500px; width: 100%;"></div> --}}
        @yield('content')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}" defer></script>
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    </body>
   </html>
