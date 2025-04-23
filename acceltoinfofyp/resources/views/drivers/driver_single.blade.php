@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="container">
    @if ($driverStats)
        <h1>{{ $driver->name }}</h1>
        <p>Number of Wins: {{ $driverStats->number_of_wins }}</p>
        <p>Number of Podiums: {{ $driverStats->number_of_podiums }}</p>
    @else
        <div class="message-box">
            <p>Driver stats not found.</p>
        </div>
    @endif

    <a href="/drivers" class="btn-primary">Back to Drivers</a>
</div>

@endsection
