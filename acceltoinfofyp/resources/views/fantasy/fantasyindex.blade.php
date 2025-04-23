@extends('admin.nav')
@section('content')
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

<div class="team-details">
    <h3>Drivers</h3>
    <ul>
        @if ($team->drivers )
            @foreach ($team->drivers as $driver)
                <li>{{ $driver->name }} (Points: {{ $driver->current_points }})</li>
            @endforeach
        @else
            <li>No drivers added yet.</li>
        @endif
    </ul>
</div>


<div class="team-details">
    <h3>Teams</h3>
    <ul>
        @if ($team && $team->teams && $team->teams->count() > 0)
            @foreach ($team->teams as $teamEntry)
                <li>{{ $teamEntry->name }}</li>
            @endforeach
        @else
            <li>No teams added yet.</li>
        @endif
    </ul>
</div>


<div class="team-points">
    <h3>Total Driver Points</h3>
    <p><strong>{{ $team && $team->drivers ? $team->drivers->sum('current_points') : 0 }}</strong></p>
</div>

</div>

<h3>Current Drivers in Your Team:</h3>
<ul>@if(!$team)
    @foreach ($team->drivers as $driver)
        <li>
            {{ $driver->name }}
            <form method="POST" action="/fantasy-team/remove-driver" style="display:inline;">
                @csrf
                <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                <button type="submit">Remove</button>
            </form>
        </li>
    @endforeach
    @else
        <li>No driver in team</li>
        @endif
</ul>

<h3>Current Teams in Your League:</h3>
<ul>
@if(!$team)
    @foreach ($team->teams as $teamEntry)
        <li>
            {{ $teamEntry->name }}
            <form method="POST" action="/fantasy-team/remove-team" style="display:inline;">
                @csrf
                <input type="hidden" name="team_id" value="{{ $teamEntry->id }}">
                <button type="submit">Remove</button>
            </form>
        </li>
    @endforeach
    @else
        <li>No driver in team</li>
        @endif
</ul>
@endsection
