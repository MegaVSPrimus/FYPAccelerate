@extends('admin.nav')
@section('content')

<style>
    .form-group {
        margin-bottom: 15px;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .alert {
        margin: 10px 0;
        padding: 10px;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

    .image-selection-container label img {
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .image-selection-container label img:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .image-selection-container img.selected {
        border: 3px solid blue;
        border-radius: 5px; /* Optional: Rounded corners */
        padding: 3px; /* Optional: Spacing adjustment */
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="forumcreate" enctype="multipart/form-data">
    @csrf

    <!-- Title Field -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <!-- Description Field -->
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
    </div>

    <!-- Category Dropdown -->
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="" disabled selected>Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Display Stored Images for Selection -->
    <div class="form-group">
        <label>Select an Image</label>
        <div class="image-selection-container" style="display: flex; flex-wrap: wrap; gap: 10px;">
            @foreach($images as $image)
                <label style="display: block; text-align: center;" class="image-option">
                    <img src="{{ asset('storage/'.$image->pathNew) }}" 
                         alt="{{ $image->name }}" 
                         style="width: 150px; height: auto; border: 1px solid #ccc; padding: 5px;" 
                         data-image-id="{{ $image->id }}">
                </label>
            @endforeach
            <!-- Hidden Input to Store Selected Image ID -->
            <input type="hidden" name="selected_image" id="selected_image" value="" required>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageContainer = document.querySelector('.image-selection-container');
        const hiddenInput = document.getElementById('selected_image');

        imageContainer.addEventListener('click', function (event) {
            const clickedImage = event.target;

            // Check if the clicked element is an image
            if (clickedImage.tagName === 'IMG') {
                // Remove 'selected' styling from all images
                document.querySelectorAll('.image-option img').forEach(img => {
                    img.classList.remove('selected');
                });

                // Apply 'selected' styling to the clicked image
                clickedImage.classList.add('selected');

                // Update the hidden input value with the selected image ID
                hiddenInput.value = clickedImage.getAttribute('data-image-id');
            }
        });
    });
</script>

@endsection
