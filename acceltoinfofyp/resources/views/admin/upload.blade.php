@extends('admin.nav')

@section('content')

<style>
    /* General Styling */
    body {
        font-family: 'Open Sans', sans-serif;
        background-color: #f4f4f9; /* Soft grey for consistency */
        color: #333;
        margin: 0;
        padding: 20px;
    }

    /* Page Container */
    .upload-container {
        max-width: 600px;
        margin: 0 auto; /* Centered layout */
        padding: 20px;
        background-color: #fff; /* White background for contrast */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        text-align: center;
    }

    .upload-container h2 {
        font-size: 24px;
        color: #0074d9; /* Formula 1 blue */
        margin-bottom: 20px;
    }

    /* Input Fields */
    input[type="text"],
    input[type="file"] {
        display: block;
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    input[type="text"]:focus,
    input[type="file"]:focus {
        outline: none;
        border-color: #0074d9; /* Blue border on focus */
        box-shadow: 0 0 5px rgba(0, 116, 217, 0.3); /* Glow effect */
    }

    /* Upload Button */
    button[type="submit"] {
        background-color: #007BFF; /* Blue button */
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth hover */
    }

    button[type="submit"]:hover {
        background-color: #0056b3; /* Darker blue on hover */
        transform: scale(1.05); /* Slight zoom effect */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .upload-container {
            padding: 15px;
            width: 90%; /* Adjust width on smaller screens */
        }

        input[type="text"],
        input[type="file"] {
            font-size: 14px; /* Smaller font size for mobile */
        }

        button[type="submit"] {
            font-size: 16px;
        }
    }
</style>

<div class="upload-container">
    <h2>Upload an Image</h2>
    <form action="{{ route('image.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="text" name="name" placeholder="Image Name" required>
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>
</div>

@endsection
