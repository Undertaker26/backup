@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header">
        <h2>{{ $user->username }}</h2>
        <p>{{ $user->email }}</p> <!-- Add other profile details here -->
    </div>

    <h3>Recent Posts</h3>
    <div class="recent-posts">
        @foreach($posts as $post)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>{{ $post->title }}</h4>
                    <p>{{ Str::limit($post->content, 200, '...') }}</p>
                    @if($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-fluid">
                    @endif
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
