@extends('admin.nav')

@section('content')
<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
@if(auth()->check() && auth()->user()->is_admin)
<form action="/admin/points" method="GET">
                    @csrf
                    <input type="submit" value="Edit Points">
                </form>
                @endif
<form method="POST" action="/fantasy-team/add-driver">
    @csrf
    <label for="driver">Choose a driver:</label>
    <select name="driver_id" id="driver">
        @foreach ($drivers as $driver)
            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
        @endforeach
    </select>
    <button type="submit">Add Driver</button>
</form>
<form method="POST" action="/fantasy-team/add-team">
    @csrf
    <label for="team">Select a Team:</label>
    <select name="team_id" id="team-select">
        @foreach ($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
        @endforeach
    </select>
    <button type="submit">Add Team</button>
</form>
<div class="container">
    <h1>My Fantasy Team</h1>

    <div class="team-details">
        <h3>Drivers</h3>
        <ul>
            @if(!$fantasyTeam)
            @foreach ($fantasyTeam->drivers as $driver)
                <li>{{ $driver->name }} (Points: {{ $driver->points->points ?? 0 }})</li>
            @endforeach
            @else
            <li>No drivers available</li>
            @endif
        </ul>
    </div>
    <div class="team-details">
        <h3>Drivers</h3>
        <ul>
            @foreach ($fantasyTeam->teams as $team)
                <li>{{ $team->name }} (Points: {{ $team->points->points ?? 0 }})</li>
            @endforeach
        </ul>
    </div>

    <div class="team-points">
    <h3>Total Points</h3>
    <p><strong>{{ $fantasyTeam && $fantasyTeam->drivers ? $fantasyTeam->drivers->sum(function ($driver) {
        return $driver->points->points ?? 0;
    }) : 0 }}</strong></p>
</div>


</div>

<h3>Current Drivers in Your Team:</h3>
<ul>
    @foreach ($fantasyTeam->drivers as $driver)
        <li>
            {{ $driver->name }}
            <form method="POST" action="/fantasy-team/remove-driver" style="display:inline;">
                @csrf
                <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                <button type="submit">Remove</button>
            </form>
        </li>
    @endforeach
</ul>
<h3>Current Teams in Your League:</h3>

<ul>
    @foreach ($fantasyTeam->teams as $team)
        <li>
            {{ $team->name }}
            <form method="POST" action="/fantasy-team/remove-team" style="display:inline;">
                @csrf
                <input type="hidden" name="team_id" value="{{ $team->id }}">
                <button type="submit">Remove</button>
            </form>
        </li>
    @endforeach
</ul>


@endsection
