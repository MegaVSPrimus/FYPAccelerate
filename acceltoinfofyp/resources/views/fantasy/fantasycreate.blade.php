@extends('admin.nav')
@section('content')
<div class="container">
    <h1>Add Drivers to Your Fantasy Team</h1>

    <form method="POST" action="/fantasy-team/add-driver" id="driver-form">
        @csrf
        <label for="driver">Select a Driver:</label>
        <select name="driver_id" id="driver-select">
            @foreach ($drivers as $driver)
                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
            @endforeach
        </select>

        <button type="submit" id="add-driver-btn">Add Driver</button>
    </form>

    <div id="feedback" style="color: red; margin-top: 10px;"></div>

    <h3>Current Drivers in Your Team:</h3>
    <ul>
        @foreach ($team->drivers as $driver)
            <li>{{ $driver->name }}</li>
        @endforeach
    </ul>
</div>

<script>
    const driverCount = {{ $team->drivers->count() }};
    const maxDrivers = 5;

    document.getElementById('driver-form').addEventListener('submit', function (event) {
        if (driverCount >= maxDrivers) {
            event.preventDefault(); // Prevent form submission
            document.getElementById('feedback').textContent = 'You can only have up to 5 drivers in your fantasy team.';
        }
    });
</script>
@endsection

