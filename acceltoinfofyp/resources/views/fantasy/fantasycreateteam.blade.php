@extends('admin.nav')
@section('content')
<div class="container">
    <h1>Add Teams to Your Fantasy League</h1>

    <form method="POST" action="/fantasy-team/add-team" id="team-form">
        @csrf
        <label for="team">Select a Team:</label>
        <select name="team_id" id="team-select">
            @foreach ($teams as $team)
                <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>

        <button type="submit" id="add-team-btn">Add Team</button>
    </form>

    <div id="feedback" style="color: red; margin-top: 10px;"></div>

    <h3>Current Teams in Your League:</h3>
    <ul>
        @foreach ($fantasyLeague->teams as $team)
            <li>{{ $team->name }}</li>
        @endforeach
    </ul>
</div>

<script>
    const teamCount = {{ $fantasyLeague->teams->count() }};
    const maxTeams = 3;

    document.getElementById('team-form').addEventListener('submit', function (event) {
        if (teamCount >= maxTeams) {
            event.preventDefault(); // Prevent form submission
            document.getElementById('feedback').textContent = 'You can only have up to 3 teams in your fantasy league.';
        }
    });
</script>
@endsection
