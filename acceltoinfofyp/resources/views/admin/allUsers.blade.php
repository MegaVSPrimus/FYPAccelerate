@extends('admin.nav')

@section('content')

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f4f4f9; /* Soft grey for consistency */
        color: #333;
        margin: 0;
        padding: 20px;
    }

    /* Container Styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff; /* White background for cards */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .section-title {
        font-size: 24px;
        font-weight: bold;
        color: #0074d9; /* Formula 1 blue theme */
        margin-bottom: 20px;
        text-align: center;
    }

    /* User Cards */
    .item {
        padding: 15px;
        margin-bottom: 15px;
        background-color: rgb(141, 183, 215); /* Light blue for consistency */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Card shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .item:hover {
        transform: translateY(-5px); /* Lift effect */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Deepen shadow */
    }

    .item p {
        font-size: 16px;
        margin: 5px 0;
        color: #555;
    }

    /* Form Styling */
    form {
        margin: 10px 0;
        text-align: center;
    }

    label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        display: inline-block;
        margin-bottom: 5px;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    /* Buttons */
    button[type="submit"] {
        background-color: #007BFF; /* Blue button */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue hover effect */
        transform: scale(1.05); /* Slight zoom */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .item {
            padding: 10px;
            font-size: 14px;
        }

        button[type="submit"] {
            font-size: 14px;
            padding: 8px 15px;
        }
    }
</style>

<div class="container">
    <p class="section-title">Manage Users</p>
    @foreach ($allUsers as $user)
        <div class="item">
            <p><b>Name:</b> {{ $user->name }}</p>
            <p><b>Email:</b> {{ $user->email }}</p>
            @if(auth()->check() && auth()->user()->is_admin)
                <p><b>Admin Status:</b> {{ $user->is_admin ? 'Yes' : 'No' }}</p>
            @endif

            <!-- Update Admin Status Form -->
            <form action="{{ route('users.updateAdmin', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <label>
                    <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}>
                    Make Admin
                </label>
                <button type="submit">Update</button>
            </form>
        </div>
    @endforeach
</div>

@endsection
