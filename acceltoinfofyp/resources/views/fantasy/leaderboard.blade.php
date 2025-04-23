@extends('admin.nav')

@section('content')
<Style>
    .container {
    width: 90%;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
}

h1, h2 {
    color: #333;
    border-bottom: 2px solid #ff6600;
    padding-bottom: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 18px;
    text-align: left;
}

table th, table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

table thead tr {
    background-color: #333;
    color: white;
    text-align: center;
}

table tbody tr:nth-of-type(even) {
    background-color: #f9f9f9;
}

table tbody tr:nth-of-type(odd) {
    background-color: #fff;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

.league {
    margin-bottom: 40px;
    padding: 10px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
}

    </style>

<div class="container">
    <h1>Fantasy Team Leaderboard</h1>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Fantasy Team Name</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fantasyTeams->sortByDesc('total_points') as $index => $team)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->total_points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
