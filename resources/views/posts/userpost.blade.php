@extends('layouts.layout')

<title>Student Section</title>
<link rel="stylesheet" href="css/post.css">

@section('content')
<div class="post-container">
    <div id="postsContainer">
        <br>
        <br>
        <center>
            @if(auth()->check())
                <h2 class="display-5 fw-bold">Hello, {{ auth()->user()->username }}</h2>
                <p class="col-md-8 fs-4">Welcome to Scribe Entertainment.</p>
            @else
                <h1 class="display-5 fw-bold">Hi, Guest</h1>
            @endif
            <br>
            <a href="{{ route('posts.create') }}" class="create">Create a new post</a>
        </center>
        <br><br>

        @foreach($posts as $post)
            <div class="postsContainer mb-4">
                <div class="card">
                    <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                    <!-- Profile Image and Username -->
                    <div class="d-flex align-items-center">
                        <img src="{{ $post->user->profile_image_url ?? 'user.png' }}" alt="Profile Image" class="profile">
                        <strong>{{ $post->user->username }}</strong>
                    </div>
                    
                    <!-- Edit and Delete Buttons -->
                    @if(auth()->user()->id == $post->user_id)
                        <div class="post-actions-top-right">
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-outline-warning me-2 no-underline">Edit</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
                        <h4>{{ $post->title }}</h4>
                        <p id="content-{{ $post->id }}" class="text-content">
                            <span class="short-content">{{ Str::limit($post->content, 200, '...') }}</span>
                            <span class="full-content d-none">{{ $post->content }}</span>
                            <a href="#" class="btn btn-link see-more-link d-none" onclick="toggleContent({{ $post->id }}); return false;">Read More</a>
                        </p>
                        @if($post->image)
                            <div class='post-images mb-2'>
                                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="post-image">
                            </div>
                        @endif
                        <small class="text-muted d-block mb-2">{{ $post->created_at->diffForHumans() }}</small>

<div class="post-actions mb-3 border-bottom">
    <form action="{{ route('posts.like', $post) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-danger btn-sm">❤ {{ $post->likes_count }} Like</button>
    </form>
    <div class="me-2">
        <!-- Add an ID to the Comment button -->
        <button id="comment-btn-{{ $post->id }}" class="btn btn-outline-secondary me-2">💬 Comment</button>
    </div>
    <form action="{{ route('posts.share', $post) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-outline-primary btn-sm">🔗 Share</button>
    </form>
</div>
<div class="mt-2">
                            <strong>Comments:</strong>
                            <ul class="list-unstyled comment-list">
                                @php
                                    $visibleComments = $post->comments->take(1); // Adjust the number of visible comments here
                                    $hiddenComments = $post->comments->slice(1);
                                @endphp

                                @foreach($visibleComments as $comment)
                                    <li class="mt-1">
                                        <strong>{{ $comment->user->username }}:</strong> {{ censorBadWords($comment->content) }}
                                        <button class="btn btn-outline-secondary btn-sm ms-2" onclick="replyToComment('{{ $comment->user->username }}', {{ $comment->id }})">Reply</button>
                                        @if(auth()->user()->id == $comment->user_id || auth()->user()->is_admin)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                            </form>
                                        @endif
                                        <div id="reply-box-{{ $comment->id }}" class="reply-box mt-2" style="display:none;">
                                            <form action="{{ route('posts.comment', $post) }}" method="POST">
                                                @csrf
                                                <textarea name="content" placeholder="Reply to this comment" class="form-control mb-2"></textarea>
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                                            </form>
                                        </div>
                                        @foreach($comment->replies as $reply)
                                            <li class="mt-1 ms-4">
                                                <strong>{{ $reply->user->username }}:</strong> {{ censorBadWords($reply->content) }}
                                                @if(auth()->user()->id == $reply->user_id || auth()->user()->is_admin)
                                                    <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </li>
                                @endforeach

                                @if($hiddenComments->count() > 0)
                                    <button class="btn btn-link" onclick="showAllComments({{ $post->id }})">Show All Comments</button>
                                @endif
                                @foreach($hiddenComments as $comment)
                                    <li class="mt-1 d-none hidden-comment">
                                        <strong>{{ $comment->user->username }}:</strong> {{ censorBadWords($comment->content) }}
                                        <button class="btn btn-outline-secondary btn-sm ms-2" onclick="replyToComment('{{ $comment->user->username }}', {{ $comment->id }})">Reply</button>
                                        @if(auth()->user()->id == $comment->user_id || auth()->user()->is_admin)
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                            </form>
                                        @endif
                                        <div id="reply-box-{{ $comment->id }}" class="reply-box mt-2" style="display:none;">
                                            <form action="{{ route('posts.comment', $post) }}" method="POST">
                                                @csrf
                                                <textarea name="content" placeholder="Reply to this comment" class="form-control mb-2"></textarea>
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <button type="submit" class="btn btn-primary">Submit Reply</button>
                                            </form>
                                        </div>
                                        @foreach($comment->replies as $reply)
                                            <li class="mt-1 ms-4">
                                                <strong>{{ $reply->user->username }}:</strong> {{ censorBadWords($reply->content) }}
                                                @if(auth()->user()->id == $reply->user_id || auth()->user()->is_admin)
                                                    <form action="{{ route('comments.destroy', $reply->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                                                    </form>
                                                @endif
                                            </li>
                                        @endforeach
                                    </li>
                                @endforeach

<div id="comment-box-{{ $post->id }}" class="comment-box mt-3">
    <div id="initial-comment-box-{{ $post->id }}" class="initial-comment-box" onclick="expandCommentBox({{ $post->id }})">
        <img src="user.png" alt="Profile Image" class="profile-image2">
        <span class="placeholder">Comment as {{ auth()->user()->username }}</span>
    </div>

    <form id="expanded-comment-box-{{ $post->id }}" action="{{ route('posts.comment', $post) }}" method="POST" class="expanded-comment-box" style="display: none;">
        @csrf
        <img src="user.png" alt="Profile Image" class="profile-image">
        <textarea name="content" placeholder="Write your comment here..." class="form-control mb-2" id="comment-textarea-{{ $post->id }}"></textarea>
        <input type="hidden" name="parent_id" id="parent-id-{{ $post->id }}">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
    </form>
</div>


<script>
    document.getElementById('comment-btn-{{ $post->id }}').addEventListener('click', function() {
        expandCommentBox({{ $post->id }});
    });

    function expandCommentBox(postId) {
        var initialBox = document.getElementById('initial-comment-box-' + postId);
        var expandedBox = document.getElementById('expanded-comment-box-' + postId);
        var textarea = document.getElementById('comment-textarea-' + postId);

        // Show the expanded comment box and hide the initial one
        initialBox.style.display = 'none';
        expandedBox.style.display = 'flex';

        // Focus on the textarea
        textarea.focus();
    }
</script>

                                  
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.text-content').forEach(function(contentElement) {
            var content = contentElement.querySelector('.short-content').innerText;
            var seeMoreLink = contentElement.querySelector('.see-more-link');
            if (content.length < 200) {
                seeMoreLink.classList.add('d-none');
            }
        });
    });

    function toggleContent(postId) {
        var contentElement = document.getElementById('content-' + postId);
        var shortContent = contentElement.querySelector('.short-content');
        var fullContent = contentElement.querySelector('.full-content');
        shortContent.classList.toggle('d-none');
        fullContent.classList.toggle('d-none');
        contentElement.querySelector('.see-more-link').classList.add('d-none');
    }

    function toggleCommentBox(postId) {
        var commentBox = document.getElementById('comment-box-' + postId);
        commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';
    }

    function replyToComment(username, commentId) {
        var replyBox = document.getElementById('reply-box-' + commentId);
        var parentInput = document.getElementById('parent-id-' + commentId);
        parentInput.value = commentId;
        replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
    }
    

    function showAllComments(postId) {
        var postElement = document.getElementById('postsContainer');
        var hiddenComments = postElement.querySelectorAll('.hidden-comment');
        hiddenComments.forEach(function(comment) {
            comment.classList.remove('d-none');
        });
        postElement.querySelector('.btn-link').style.display = 'none';
    }
</script>
@endsection
