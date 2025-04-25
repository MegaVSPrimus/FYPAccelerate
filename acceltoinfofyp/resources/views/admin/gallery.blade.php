@extends('admin.nav')

@section('content')

<style>
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f4f4f9; /* Light background for consistency */
        color: #333;
        margin: 0;
        padding: 20px;
    }

    /* Container styling */
    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* Responsive grid layout */
        gap: 20px;
        padding: 20px;
        background-color: rgb(141, 183, 215); /* Light blue for consistency */
        border-radius: 10px;
    }

    .image-card {
        background-color: #fff; /* White for card contrast */
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Hover effect */
    }

    .image-card:hover {
        transform: translateY(-5px); /* Lift effect */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Increased shadow depth */
    }

    .image-card img {
        width: 100%;
        max-width: 200px;
        height: auto;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .image-card h3 {
        font-size: 18px;
        color: #0074d9; /* Formula 1 blue */
        margin-bottom: 10px;
    }

    .image-card form {
        margin: 10px 0; /* Spacing between forms */
    }

    /* Buttons styling */
    input[type="submit"] {
        background-color: #007BFF; /* Blue button */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth hover */
    }

    input[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue for hover */
        transform: scale(1.05); /* Slight zoom effect */
    }

    /* Input fields */
    input[type="text"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    label {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 5px;
    }
</style>

<div class="image-grid">
    @foreach ($images as $image)
        <div class="image-card">
            <!-- Image Display -->
            <h3>{{ $image->name }}</h3>
<img src="{{ asset( $image->pathNew) }}" alt="{{ $image->name }}">

            <!-- Edit Form -->
            <form action="/images/{{ $image->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <label for="name_{{ $image->id }}">Edit Name:</label>
                    <input type="text" id="name_{{ $image->id }}" name="name" value="{{ $image->name }}">
                </div>

                <div>
                    <label for="path_{{ $image->id }}">Edit Path:</label>
                    <input type="text" id="path_{{ $image->id }}" name="path" value="{{ $image->pathNew }}">
                </div>

                <div>
                    <input type="submit" value="Update">
                </div>
            </form>

            <!-- Delete Form -->
            <form action="/images/{{ $image->id }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete">
            </form>
        </div>
    @endforeach
</div>

@endsection
