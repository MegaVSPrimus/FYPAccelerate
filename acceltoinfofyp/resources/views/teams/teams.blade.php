@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

@if(auth()->check() && auth()->user()->is_admin)

<div class="create-team">
        <form action="https://fypaccelerate-production.up.railway.app/insertTeam" method="GET">
            <input type="submit" value="Create Team">
        </form>
</div>
    @endif
<div class="team-grid">
    @foreach($teams as $team)
        <div class="team-card">
            <p>
                <b>Team:</b> {{ $team->name }}
            </p>

            @php
                $matchFound = false; // Initialize the match counter variable
            @endphp

            @foreach ($images as $image)
                @if ($team->name === $image->name)
                    @php
                        $matchFound = true; // Mark a match as found
                    @endphp
                    <img src="{{ asset($image->pathNew) }}" alt="{{ $image->name }}">
                @endif
            @endforeach

            @if (!$matchFound)
                <p>No image found for {{ $team->name }}.</p>
            @endif

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="admin-actions-delete">
                    <form action="https://fypaccelerate-production.up.railway.app/teams/{{ $team->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete {{ $team->name }}">
                    </form>
                </div>

                <div class="admin-actions-edit">
                    <form action="https://fypaccelerate-production.up.railway.app/editTeam/{{ $team->id }}" method="GET">
                        @csrf
                        <input type="submit" value="Edit {{ $team->name }}">
                    </form>
                </div>
            @endif

            <div class="driver-details">
                <form action="https://fypaccelerate-production.up.railway.app/teams/{{ $team->id }}" method="GET">
                    @csrf
                    <input type="submit" value="View {{ $team->name }}'s Details">
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
