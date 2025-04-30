@extends('admin.nav')

@section('content')

@if(app()->environment('local'))
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@else
<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
@endif

<div class="container">
    @if ($team)
        <h1>{{ $team->name }}</h1>
        <p>Team Principal: {{ $team->team_principal }}</p>
        <p>Engine Supplier: {{ $team->engine_supplier }}</p>

    @else
        <div class="message-box">
            <p>Team stats not found.</p>
        </div>
    @endif

    <a href="/teams" class="btn-primary">Back to Teams</a>
</div>

@endsection
