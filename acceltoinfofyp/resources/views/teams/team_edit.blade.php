@extends('admin.nav')

@section('content')
@if(auth()->user() && auth()->user()->is_admin)
    <p>Welcome, Admin!</p>
@endif

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Edit Team</div>
            <div class="card-body">
                <form action="{{ route('team.update', ['id' => $team->id]) }}" method="POST">
                    @csrf
                    @method('PATCH') <!-- Laravel requires PATCH for updates -->

                    <!-- Team Name -->
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Team Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name', $team->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Team Principal -->
                    <div class="mb-3 row">
                        <label for="team_principal" class="col-md-4 col-form-label text-md-end text-start">Team Principal</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('team_principal') is-invalid @enderror"
                                   id="team_principal" name="team_principal" 
                                   value="{{ old('team_principal', $team->team_principal) }}">
                            @error('team_principal')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Engine Supplier -->
                    <div class="mb-3 row">
                        <label for="engine_supplier" class="col-md-4 col-form-label text-md-end text-start">Engine Supplier</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('engine_supplier') is-invalid @enderror"
                                   id="engine_supplier" name="engine_supplier" 
                                   value="{{ old('engine_supplier', $team->engine_supplier) }}">
                            @error('engine_supplier')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Constructors Championships -->
                    <div class="mb-3 row">
                        <label for="constructors_championships" class="col-md-4 col-form-label text-md-end text-start">Constructors Championships</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('constructors_championships') is-invalid @enderror"
                                   id="constructors_championships" name="constructors_championships" 
                                   value="{{ old('constructors_championships', $team->constructors_championships) }}">
                            @error('constructors_championships')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <input type="submit" class="btn btn-primary" value="Update Team">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>    
</div>

@endsection
