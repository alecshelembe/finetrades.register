@extends('welcome')

@section('content')

@if($qrCode)
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="qr-code">
            {!! QrCode::size(200)->generate(route('login', ['code' => $qrCode->code])) !!}
        </div>
        <!-- Hidden input to store the QR code -->
        <input type="hidden" name="qr_code" value="{{ $qrCode->code }}">
        <!-- Submit button -->
        {{-- <button type="submit" class="btn btn-primary">Submit QR Code</button> --}}
    </form>
@else
    <p>No QR code available for today.</p>
@endif

@endsection
