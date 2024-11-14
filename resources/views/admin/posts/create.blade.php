@extends('admin.dashboard')
@section('content')
   
    <div class="content">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="title">Post Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="category">Post Category:</label>
                <select id="category" name="category" required>
                    <option value="News">News</option>
                    <option value="Sports">Sports</option>
                    <option value="Sci-Tech">Sci-Tech</option>
                </select>
                @error('category') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="keywords">Post Keywords:</label>
                <input type="text" id="keywords" name="keywords" value="{{ old('keywords') }}" required>
                @error('keywords') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="image">Post Image:</label>
                <input type="file" id="image" name="image">
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror

                <label for="content">Post Content:</label>
                <textarea id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content') <span class="text-danger">{{ $message }}</span> @enderror

                <button type="submit">Publish Post</button>
            </form>
        </div>
    </div>
</div>
@endsection
