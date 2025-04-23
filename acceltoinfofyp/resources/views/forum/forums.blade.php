@extends('admin.nav')
@section('content')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@if(auth()->check())

<form action="/createForum" method="get">
    <button type="submit" class="btn btn-primary">Create a Post</button>
</form>
@endif
<form method="GET" action="/forums/">
    <div class="form-group">
        <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}" class="form-control">
    </div>
    <div class="form-group">
        <select name="category" class="form-control">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<div class="container">

<br>
    @foreach($forum as $forums)
    <div class="item">

            <p>{{ $forums->title }}</p>
            <p>{{$forums->description}}</p>   
            <a href="{{ route('forums.show', $forums->id) }}" class="btn btn-primary">View Post</a>

            </div>
         
    @endforeach
</div>

@endsection
