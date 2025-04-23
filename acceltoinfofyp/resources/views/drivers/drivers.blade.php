@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<div class="create-driver">
    @if(auth()->check() && auth()->user()->is_admin)
        <form action="/insert" method="GET">
            <input type="submit" value="Create Driver">
        </form>
    @endif
</div>

<div class="driver-grid">
    @foreach($drivers as $driver)
        <div class="driver-card">
            <p>
                <b>Driver:</b> {{ $driver->name }}<br>
            </p>

            @php
                $stats = $driverStats->firstWhere('driver_id', $driver->id);
                $matchFound = false;
            @endphp

            @foreach ($images as $image)
                @if ($driver->name === $image->name)
                    @php
                        $matchFound = true;
                    @endphp
                    <img src="{{ asset('storage/' . $image->pathNew) }}" alt="{{ $image->name }}">

                    
                @endif
            @endforeach

            @if (!$matchFound)
                <p>No image found for {{ $driver->name }}.</p>
            @endif

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="admin-actions-delete">
                    <form action="/drivers/{{ $driver->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete {{ $driver->name }}">
                    </form>
                </div>
                <div class="admin-actions-edit">
                    <form action="/editDriver/{{ $driver->id }}" method="GET">
                        @csrf
                        <input type="submit" value="Edit {{ $driver->name }}">
                    </form>
                </div>
                @endif

            <div class="driver-details">
                <form action="/drivers/{{ $driver->id }}" method="GET">
                    @csrf
                    <input type="submit" value="View {{ $driver->name }}'s Details">
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
