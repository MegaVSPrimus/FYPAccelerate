@extends('admin.nav')

@section('content')

<style>
/* General Body Styling */
body {
    font-family: 'Open Sans', sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
    color: #333;
}

/* Leaderboard Styling */
.leaderboard-container {
    margin-top: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.leaderboard-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #0074d9;
    text-align: center;
}

.leaderboard-table {
    width: 100%;
    border-collapse: collapse;
}

.leaderboard-table th, .leaderboard-table td {
    text-align: left;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.leaderboard-table th {
    background-color: #0074d9;
    color: #ffffff;
}

.leaderboard-table tr:hover {
    background-color: #f1f1f1;
}

/* Layout Styling */
.content-container {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two columns of equal width */
    gap: 20px;
    height: 100vh; /* Full viewport height */
    overflow: hidden;
    padding: 20px;
}

/* Left Section Styling (Formula 1 Forum Posts) */
.forum-left {
    overflow-y: auto;
    padding-right: 10px;
}

.forum-post {
    background-color: #ffffff;
    margin-bottom: 10px;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.forum-post h3 {
    color: #0074d9;
    font-size: 18px;
    margin-bottom: 5px;
}

.forum-post a {
    color: #0074d9;
    font-weight: bold;
    text-decoration: none;
}

.forum-post a:hover {
    text-decoration: underline;
}

/* Right Section Styling (Carousel) */
.carousel-container {
    position: relative;
    height: 50%; /* Occupies 50% of the screen vertically */
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
}
.carousel-item {
    flex: 0 0 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; /* Center content vertically */
    text-align: center; /* Center content horizontally */
    padding: 10px;
}


.carousel-item h3 {
    margin: 10px 0; /* Space above and below title */
    font-size: 18px;
    color: #333;
}

.carousel-item p {
    margin: 5px 0; /* Space above and below description */
    font-size: 14px;
    color: #555;
}

/* Carousel Navigation Buttons */
.carousel-controls {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
    pointer-events: none;
}

.carousel-controls button {
    pointer-events: auto;
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    font-size: 18px;
    padding: 10px;
    cursor: pointer;
    border-radius: 50%;
    transition: background-color 0.3s ease-in-out;
}

.carousel-controls button:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
    .content-container {
        grid-template-columns: 1fr; /* Stack columns vertically */
    }

    .carousel-container {
        height: 30%; /* Adjust height for smaller screens */
    }
}
</style>

<div class="content-container">
    <!-- Left Section: Formula 1 Forum Posts -->
    <div class="forum-left">
        @forelse($forums as $forum)
            @if($forum->category && $forum->category->name === 'Formula 1')
                <div class="forum-post">
                    @if($forum->image)
                        <img src="{{ asset('storage/'.$forum->image) }}" alt="Forum Image" style="width: 100%; border-radius: 5px; margin-bottom: 10px;">
                    @endif
                    <h3>{{ $forum->title }}</h3>
                    <p>{{ \Illuminate\Support\Str::limit($forum->description, 100) }}</p>
                    <a href="{{ url('forum/'.$forum->id) }}" class="btn btn-primary">Read More</a>
                </div>
            @endif
        @empty
            <p>No Formula 1 forum posts found.</p>
        @endforelse
    </div>

    <!-- Right Section: Carousel -->
    <div class="carousel-container">
        <div class="carousel-inner">
            @forelse($forums as $forum)
                @if($forum->category && $forum->category->name === 'News')
                    <div class="carousel-item">
                        <h3>{{ $forum->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($forum->description, 100) }}</p>
                        <a href="{{ url('forum/'.$forum->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                @endif
            @empty
                <div class="carousel-item">
                    <h3>No News Posts Found</h3>
                </div>
            @endforelse
        </div>
        <div class="carousel-controls">
            <button onclick="prevSlide()">&#10094;</button>
            <button onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
</div>

<!-- Fantasy Teams Leaderboard Section -->
<div class="leaderboard-container">
    <div class="leaderboard-title">Fantasy Teams Leaderboard</div>
    <table class="leaderboard-table">
        <thead>
            <tr>
                <th>Position</th>
                <th>Team Name</th>
                <th>Total Points</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fantasyTeams as $index => $team)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $team->name }}</td>
                    <td>{{ $team->total_points }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">No Fantasy Teams Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    const slides = document.querySelectorAll('.carousel-item');
    let currentSlide = 0;

    // Update the carousel position
    function updateCarousel() {
        const inner = document.querySelector('.carousel-inner');
        inner.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    // Show the next slide
    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateCarousel();
    }

    // Show the previous slide
    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        updateCarousel();
    }

    document.querySelectorAll('.carousel-controls button').forEach((button) => {
        button.addEventListener('click', () => {
            if (button.textContent.includes('❮')) prevSlide();
            if (button.textContent.includes('❯')) nextSlide();
        });
    });
</script>

@endsection
