@extends('admin.nav')

@section('content')
<div class="container">
    <h1>Add Teams to Your Fantasy League</h1>

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

    <div style="margin-top: 20px;">
        <h3>Current Teams in Your League:</h3>
        <ul>
            @foreach ($fantasyLeague->teams as $team)
                <li>{{ $team->name }}</li>
            @endforeach
        </ul>
    </div>
</div>

<h3>Current Teams in Your League:</h3>
<ul>
    @foreach ($fantasyLeague->teams as $team)
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
