<form method="POST" action="/fantasy-team/add-driver">
    @csrf
    <label for="driver">Choose a driver:</label>
    <select name="driver_id" id="driver">
        @foreach ($drivers as $driver)
            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
        @endforeach
    </select>

    <input type="hidden" name="team_id" value="{{ $team->id }}">
    <button type="submit">Add Driver</button>
</form>
