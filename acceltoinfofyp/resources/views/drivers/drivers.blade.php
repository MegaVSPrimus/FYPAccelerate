@extends('admin.nav')

@section('content')

<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">

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
                // Find the first image associated with the driver
                $driverImage = $images->firstWhere('name', $driver->name);
            @endphp

            @if ($driverImage)
                <!-- Display driver image if found -->
                <img src="{{ asset( $driverImage->pathNew) }}" alt="{{ $driver->name }}" style="width: 150px; height: auto; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            @else
                <!-- Fallback message if no image is found -->
                <p>No image found for {{ $driver->name }}.</p>
            @endif

            @if(auth()->check() && auth()->user()->is_admin)
                <!-- Admin Actions -->
                <div class="admin-actions-delete">
                    <form action="https://fypaccelerate-production.up.railway.app/drivers/{{ $driver->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete {{ $driver->name }}">
                    </form>
                </div>
                <div class="admin-actions-edit">
                    <form action="https://fypaccelerate-production.up.railway.app/editDriver/{{ $driver->id }}" method="GET">
                        <input type="submit" value="Edit {{ $driver->name }}">
                    </form>
                </div>
            @endif

            <!-- View Driver Details -->
            <div class="driver-details">
                <form action="/drivers/{{ $driver->id }}" method="GET">
                    <input type="submit" value="View {{ $driver->name }}'s Details">
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
