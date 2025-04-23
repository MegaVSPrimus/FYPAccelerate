@extends('admin.nav')

@section('content')
<form action="{{ route('authenticate') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div>
        <label>
            <input type="checkbox" name="remember" id="remember"> Remember Me
        </label>
    </div>
    
    <button type="submit">Login</button>
</form>
@endsection