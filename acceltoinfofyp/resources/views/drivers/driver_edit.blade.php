@extends('admin.nav')

@section('content')
@if(auth()->user() && auth()->user()->is_admin)
    <p>Welcome, Admin!</p>
@endif
<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Profile</div>
            <div class="card-body">
            <form action="{{ route('driver.update', ['id' => $driver->id]) }}" method="POST">
                  @csrf
                    @method('PATCH')  <!-- Laravel requires PATCH for updates -->
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Driver</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name', $driver->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="team" class="col-md-4 col-form-label text-md-end text-start">Team</label>
                        <div class="col-md-6">
                            <input type="team" class="form-control @error('team') is-invalid @enderror" 
                                   id="team" name="team" 
                                   value="{{ old('team', $driver->team) }}">
                            @error('team')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="number_of_wins" class="col-md-4 col-form-label text-md-end text-start">Driver Wins</label>
                        <div class="col-md-6">
                            <input type="number_of_wins" class="form-control @error('number_of_wins') is-invalid @enderror" 
                                   id="number_of_wins" name="number_of_wins" 
                                   value="{{ old('team', $driverStats->number_of_wins) }}">
                            @error('number_of_wins')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="points_scored" class="col-md-4 col-form-label text-md-end text-start">Points Scored</label>
                        <div class="col-md-6">
                            <input type="points_scored" class="form-control @error('points_scored') is-invalid @enderror" 
                                   id="points_scored" name="points_scored" 
                                   value="{{ old('team', $driverStats->points_scored) }}">
                            @error('points_scored')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="number_of_races" class="col-md-4 col-form-label text-md-end text-start">Driver Race Starts</label>
                        <div class="col-md-6">
                            <input type="number_of_races" class="form-control @error('number_of_races') is-invalid @enderror" 
                                   id="number_of_races" name="number_of_races" 
                                   value="{{ old('team', $driverStats->number_of_races) }}">
                            @error('number_of_races')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="number_of_podiums" class="col-md-4 col-form-label text-md-end text-start">Driver Podiums</label>
                        <div class="col-md-6">
                            <input type="number_of_podiums" class="form-control @error('number_of_podiums') is-invalid @enderror" 
                                   id="number_of_podiums" name="number_of_podiums" 
                                   value="{{ old('team', $driverStats->number_of_podiums) }}">
                            @error('number_of_podiums')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Driver">
                    </div>
                </form>
            </div>
        </div>

    </div>    
</div>

@endsection
