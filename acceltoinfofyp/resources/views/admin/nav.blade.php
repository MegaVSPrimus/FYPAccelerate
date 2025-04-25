<!DOCTYPE html>
<html>
<head>
    <title>Laravel Navigation Bar</title>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Open Sans', sans-serif; 
            background-color: #f4f4f9; /* Light grey background */
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navigation Bar Styling */
        nav {
            width: 100%;
            background-color: #0074d9; /* Formula 1 blue */
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 15px;
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
            color: #ffcc00; /* Highlight on hover */
            transform: translateY(-2px); /* Slight hover animation */
        }

        /* Highlight active page */
        nav a.active {
            border-bottom: 3px solid #ffcc00; /* Underline active link */
        }

        /* Navigation bar profile image */
        nav img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-left: 10px;
            transition: transform 0.2s ease;
        }

        nav img:hover {
            transform: scale(1.1); /* Slight zoom effect */
        }

        /* Responsive Design for Mobile */
        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
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
    <nav>
        <ul>
            <!-- Formula One Logo -->
            <li>
                <a href="/">
                    <img src="{{ asset('images/1740843778.png') }}" alt="Formula One Logo" style="width:50px; height:auto;">

                </a>
            </li>

            <!-- Navigation Links -->
            <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></li>
            <li><a class="{{ request()->is('drivers*') ? 'active' : '' }}" href="/drivers">Drivers</a></li>
            <li><a class="{{ request()->is('teams*') ? 'active' : '' }}" href="/teams">Teams</a></li>
            <li><a class="{{ request()->is('forums*') ? 'active' : '' }}" href="/forums">Forums</a></li>

            @if(auth()->check() && auth()->user()->is_admin)
                <li><a href="/allUsers">All Users</a></li>
                <li><a href="/upload">Upload</a></li>
                <li><a href="/gallery">Gallery</a></li>
            @endif

            @if(auth()->check())
                <!-- Retrieve the user's image -->
                @php
                    $userImage = \App\Models\Image::where('name', Auth::user()->name)->first();
                @endphp

                @if ($userImage)
                    <li>
                        <img src="{{ asset($userImage->path) }}" alt="Profile Image">
                    </li>
                @else
                    <li>
                        <img src="{{ asset('default-profile.png') }}" alt="Default Profile Image">
                    </li>
                @endif

                <li><a class="{{ request()->is('fantasy-team*') ? 'active' : '' }}" href="/fantasy-team">Fantasy League</a></li>
                <li><a href="/profile">Profile</a></li>
                <li><a href="/logout">Logout</a></li>
            @else
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            @endif
        </ul>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>
