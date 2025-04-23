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
            <form action="{{ route('driverstats.update', ['id' => $driver->id]) }}" method="POST">
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
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Driver">
                    </div>
                </form>
            </div>
        </div>

    </div>    
</div>

@endsection
