@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="container">
    @if ($driverStats)
    <p><b>Driver:</b> {{ $driver->name }} <br> 
    <b>Team:</b> {{ $driver->team }}</p>
            <p><b>Number of race wins: </b>{{$driverstat->number_of_wins}}</p>
            <p><b>Points scored:</b>{{$driverstat->points_scored}}</p>
            <p><b>Number of races:</b>{{$driverstat->number_of_races}}</p>
            <p><b>Number of podiums</b{{$driverstat->number_of_podiums}}></p>

    @else
        <div class="message-box">
            <p>Driver stats not found.</p>
        </div>
    @endif

    <a href="/drivers" class="btn-primary">Back to Drivers</a>
</div>

@endsection
