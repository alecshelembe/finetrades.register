@extends('welcome')

@section('content')

@if($qrCode)
    <div class="qr-code">
        {!! QrCode::size(200)->generate($qrCode->code) !!}
    </div>
    
    <form action="{{ url('/your-url') }}" method="GET">
        <input type="hidden" name="code" value="{{ $qrCode->code }}">
        {{-- <button type="submit" class="btn btn-primary">Send QR Code</button> --}}
    </form>
@else
    <p>No QR code available for today.</p>
@endif

@endsection
