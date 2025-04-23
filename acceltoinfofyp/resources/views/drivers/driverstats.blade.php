@extends('admin.nav')

@section('content')

<style>
    .driver-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .driver-card {
        padding: 15px;
        border: 1px solid #ddd;
        text-align: center;
    }
</style>

@if(auth()->check() && auth()->user()->is_admin)
    <form action="/insert" method="GET">
        <input type="submit" value="Create Driver">
    </form>
@endif

<div class="driver-grid">
    @foreach($drivers as $driver)
    @foreach($driverStats as $driverstat)
        <div class="driver-card">
            <p><b>Driver:</b> {{ $driver->name }} <br> <b>Team:</b> {{ $driver->team }}</p>
            <p><b>Number of race wins: </b>{{$driverstat->number_of_wins}}</p>
            <p><b>Points scored:</b>{{$driverstat->points_scored}}</p>
            <p><b>Number of races:</b>{{$driverstat->number_of_races}}</p>
            <p><b>Number of podiums</b{{$driverstat->number_of_podiums}}></p>
            
            @foreach ($images as $image)
                @if ($driver->name === $image->name)
                    <div>
                        <img src="{{ asset('storage/' . $image->pathNew) }}" alt="{{ $image->name }}" width="200">
                    </div>
                @endif
            @endforeach
            @endforeach

            <form action="/drivers/{{$driver->id}}" method="GET",style="display:inline;">
            @csrf
<input type="submit" value="View {{$driver->name}}'s Details">
</form>

            <a href="/drivers/{{$driver->id}}">View Details</a>

            @if(auth()->check() && auth()->user()->is_admin)
                <form action="/drivers/{{ $driver->id }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete {{ $driver->name }}">
                </form>

                <form action="/editDriver/{{ $driver->id }}" method="GET" style="display: inline;">
                    @csrf
                    <input type="submit" value="Edit {{ $driver->name }}">
                </form>
            @endif
        </div>
    @endforeach
</div>

@endsection
