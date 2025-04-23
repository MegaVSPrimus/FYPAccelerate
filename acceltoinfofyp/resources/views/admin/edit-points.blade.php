@extends('nav')

@section('content')
<div class="container">
    <h1>Edit Points</h1>

    <form method="POST" action="/admin/points/">
        @csrf

        <h2>Drivers</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current Points</th>
                    <th>Set Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->points->points ?? 0 }}</td>
                        <td>
                            <input type="number" name="drivers[{{ $driver->id }}]" value="{{ $driver->points->points ?? 0 }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Teams</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Current Points</th>
                    <th>Set Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->points->points ?? 0 }}</td>
                        <td>
                            <input type="number" name="teams[{{ $team->id }}]" value="{{ $team->points->points ?? 0 }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Update Points</button>
    </form>
</div>
@endsection
