@extends('admin.nav')

@section('content')
@if(app()->environment('local'))
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@else
<link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
@endif

<div class="container">
    @if ($forum)
        <h1>{{ $forum->title }}</h1>
        <p>{{ $forum->description }}</p>
    @else
        <p>Forum post not found.</p>
    @endif

    @if(Auth::check())
        <form action="{{ route('forum.destroy', $forum->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete {{ $forum->title }}">
        </form>

        <form action="editForum/{{ $forum->id }}" method="GET">
            @csrf
            <input type="submit" value="Edit {{ $forum->title }}">
        </form>
    @endif

    @if($forum->image)
        <img src="{{ asset('storage/'.$forum->image) }}" alt="Forum Image">
    @endif

    <div class="comment-section">
        <h2>Comments</h2>
        @foreach($forum->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->name }}</strong> said:
                <p>{{ $comment->content }}</p>
                <small>Posted on {{ $comment->created_at->format('M d, Y') }}</small>
            </div>
        @endforeach

        @if(Auth::check())
            <form action="{{ route('comments.store', $forum->id) }}" method="POST">
                @csrf
                <textarea name="content" required placeholder="Write a comment..." rows="3"></textarea>
                <button type="submit">Post Comment</button>
            </form>
        @else
            <p>You must be logged in to comment.</p>
        @endif
    </div>

    <a href="forum" class="btn btn-primary">Back to Forums</a>
</div>
@endsection
