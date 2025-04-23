@extends('admin.nav')

@section('content')
@if(auth()->user() && auth()->user()->is_admin)
    <p>Welcome, Admin!</p>
@endif
<form method="POST" action="{{ route('forum.update', $forum->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH') <!-- Update the method to PATCH -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $forum->title) }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $forum->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (old('category_id', $forum->category_id) == $category->id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    @if($forum->image)
        <div class="form-group">
            <img src="{{ asset('storage/' . $forum->image) }}" alt="Forum Image" class="img-thumbnail" width="200">
            <p>Current Image: {{ $forum->image }}</p>
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection
