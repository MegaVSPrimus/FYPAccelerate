<!DOCTYPE html>
<html>
<head>
    <title>Laravel Navigation Bar</title>
    <style>
        
/* Navigation Bar Styling */
/* General Body Styling */
nav {
    width: 100%; /* Ensure the navbar fits the screen */
    overflow: hidden; /* Prevent overflow */
    background-color: #333; /* Example color */
    display: flex; /* Use flexbox for layout */
    align-items: center;
    justify-content: space-between; /* Space elements evenly */
    padding: 10px 20px; /* Add padding for spacing */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional shadow */
}

nav a {
    color: white; /* Example link color */
    text-decoration: none; /* Remove underline */
    margin: 0 10px; /* Spacing between links */
}

nav a:hover {
    text-decoration: underline; /* Optional hover effect */
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    nav {
        flex-direction: column; /* Stack items vertically */
        align-items: flex-start; /* Align to the left */
    }

    nav a {
        margin: 10px 0; /* Add spacing for stacked links */
    }
}

body {
    font-family: 'Open Sans', sans-serif; /* Matches drivers page font */
    background-color: #f4f4f9; /* Light grey for consistency */
    color: #333;
}

/* Navigation Bar Styling */
nav {
    background-color: #0074d9; /* Formula 1 blue */
    padding: 15px;
    position: sticky;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    justify-content: space-between; /* Spread out items */
    align-items: center;
    gap: 15px; /* Adds spacing between items */
}

nav li {
    display: inline-block;
}

nav a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    transition: color 0.3s ease, transform 0.2s ease;
}

nav a:hover {
    color: #ffcc00;
    transform: translateY(-2px); /* Slight hover animation */
}

/* Highlight active page */
nav a.active {
    border-bottom: 3px solid #ffcc00; /* Underline the active link */
}

/* Navigation bar profile image */
nav img {
    width: 40px;
    height: 40px;
    border-radius: 50%; /* Makes the image circular */
    object-fit: cover; /* Ensures the image looks good */
    margin-left: 10px;
    transition: transform 0.2s ease;
}

nav img:hover {
    transform: scale(1.1); /* Slight zoom effect */
}

/* Responsive Design for Mobile View */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column; /* Stack items vertically */
        gap: 10px;
    }

    nav a {
        font-size: 14px;
        text-align: center;
    }

    nav img {
        margin: 0 auto;
    }
}




        </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="/">
        <img src="{{ asset('storage/images/1740843778.png') }}" alt="Formula One Logo" style="width:50px; height:auto;">

    </a>
</li>
        
<li class="nav-item">
    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link {{ request()->is('drivers*') ? 'active' : '' }}" href="/drivers">Drivers</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('teams*') ? 'active' : '' }}" href="/teams">Teams</a>
</li>

<li class="nav-item">
    <a class="nav-link {{ request()->is('forums*') ? 'active' : '' }}" href="/forums">Forums</a>
</li>
@if(auth()->check() && auth()->user()->is_admin)

    <li class="nav-item">
        <a class="nav-link" href="/allUsers">All Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/upload">Upload</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/gallery">Gallery</a>
    </li>
    @endif
    @if(auth()->check())
    @php
        // Retrieve the user's image from the database
        $userImage = \App\Models\Image::where('name', Auth::user()->name)->first();
    @endphp

    @if ($userImage)

    <img src="{{ asset('storage/' . $userImage->path) }}" alt="Profile Image">
@else
    <img src="{{ asset('storage/images/default-profile.png') }}" alt="Default Profile Image">
@endif


<li class="nav-item">
    <a class="nav-link {{ request()->is('fantasy-team*') ? 'active' : '' }}" href="/fantasy-team">Fantasy League</a>
</li>

        <li class="nav-item">
            <a class="nav-link" href="/profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">Logout</a>
        </li>
    @else
        <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
        </li>
    @endif
</ul>

        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

   
</body>
</html>
