@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">


<div class="container">
    @if ($team)
        <h1>{{ $team->name }}</h1>
        <p>Team Principal: {{ $team->team_principal }}</p>
    @else
        <div class="message-box">
            <p>Team stats not found.</p>
        </div>
    @endif

    <a href="/teams" class="btn-primary">Back to Teams</a>
</div>

@endsection
