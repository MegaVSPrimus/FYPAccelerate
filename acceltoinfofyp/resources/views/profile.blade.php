@extends('admin.nav')

@section('content')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@if(auth()->user() && auth()->user()->is_admin)
    <p>Welcome, Admin!</p>
@endif
            <div class="card-header">Profile</div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    <div class="form-profile-name">
                    @csrf
                    @method('PATCH') 
                    <div class="form-profile-name">

                    <label for="name" >Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" 
                                   value="{{ old('name', auth()->user()->name) }}">

                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

<div class="forum-profile-email">
                        <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', auth()->user()->email) }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

<div class="forum-profile-password">
                    <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password </label>

                                   <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">

                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    

                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Profile">
                    </div>
                </form>
                <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Image Name" required>
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>
            </div>
        </div>

    </div>    
</div>

@endsection
