@extends('layouts.layout')

<title>Create a Post</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">


@section('title', 'Posts')

@section('content')
<div class="main-container">
    <div id="postsContainer">
        <center>
            @if(auth()->check())
                <h1 class="display-5 fw-bold"> {{ auth()->user()->username }}</h1>
            @else
                <h1 class="display-5 fw-bold">Hi, Guest</h1>
            @endif
<br>


            <a href="{{ route('posts.create') }}" class="create">Create a new post</a>
        </center>  
        <br>
        <style>
            
    .post-container {
        border: 1px solid #e3e3e3;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }
    .post-image {
        max-width: 100%;
        height: auto;
    }
    .create:hover {
        color: white;
        text-decoration: none;
    }
    .create {
        padding: 10px;
        background-color: blue;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 13px;
        text-decoration: none;
        text-align: center;
        display: inline-block;
    }
    .comment-box {
        display: none;
    }
    .card-body {
        padding: 20px;
    }
    .btn {
        margin-right: 10px;
    }
    
</style>
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
@endsection
    <!-- <div class="main-container">
        <div class="post-input">
            <img src="user.png" alt="User Icon" width="40">
            <input type="text" id="postText" placeholder="Enter Text">
            <label for="fileInput">Add Photo/Video</label>
            <input type="file" id="fileInput" style="display:none;">
            <button class="live-video">Live Video</button>
            <button onclick="addPost()">Post</button>
        </div>
        <div id="postsContainer">
            <div class='post'>
                <div class='post-header'>
                    <div class='user-info'>
                        <img src="user.png" alt="User Icon" width='40'>
                        <div>
                            <strong>UCU</strong><br>
                            <small>July 1, 2024</small>
                        </div>
                    </div>
                </div>
                <div class='post-content'>
                    <h2>UCU, Basketball Associations Sign MOA to Accelerate Sports Progress</h2>
                    <p>To strengthen and to open more opportunities to sports, Urdaneta City University signed a memorandum of agreement with Samahang Basketball ng Pilipinas...</p>
                    <div class='post-images'>
                        <img src='wiw.jpg' alt='Post Image'>
                    </div>
                </div>
                <div class="post-footer">
                    <span><span class="footer-heart-count">0</span> hearts</span>
                    <span><span class="footer-comment-count">0</span> comments</span>
                </div>
                <div class='post-actions'>
                    <button onclick='heartPost(this)'>
                        <img src="heart.png" alt="Heart Icon"> <span class='heart-count'>0</span>Heart</button>
                    </button>
                    <button onclick='commentPost(this)'>
                        <img src="comment.png" alt="Comment Icon">Comment</button>
                    </button>
                    <button onclick='sharePost()'>
                        <img src="/share.png" alt="Share Icon">Share</button>
                    </button>
                </div>
                <div class='comment-section'></div>
            </div>
        </div>
    </div>
    <script>
        let userName = "New User"; // Placeholder for user name
        let likedPosts = new Set(); // To track liked posts

        function heartPost(button) {
            const postId = button.closest('.post').getAttribute('data-post-id');
            if (likedPosts.has(postId)) return; // Prevent multiple likes from the same user
            likedPosts.add(postId);
            
            const heartCountSpan = button.querySelector('.heart-count');
            let count = parseInt(heartCountSpan.textContent);
            heartCountSpan.textContent = count + 1;
            
            const footerHeartCount = button.closest('.post').querySelector('.footer-heart-count');
            footerHeartCount.textContent = parseInt(footerHeartCount.textContent) + 1;
        }

        function commentPost(button) {
            let commentSection = button.closest('.post').querySelector('.comment-section');
            let commentInput = document.createElement('input');
            commentInput.type = 'text';
            commentInput.placeholder = 'Write a comment...';
            let submitComment = document.createElement('button');
            submitComment.textContent = 'Submit';
            submitComment.onclick = function() {
                let commentText = commentInput.value;
                if (commentText) {
                    let comment = document.createElement('div');
                    comment.className = 'comment';
                    comment.innerHTML = `<img src="user.png" alt="User Image"> <div>${userName}: ${commentText}</div>`;
                    commentSection.appendChild(comment);
                    commentInput.remove();
                    submitComment.remove();
                    
                    const footerCommentCount = button.closest('.post').querySelector('.footer-comment-count');
                    footerCommentCount.textContent = parseInt(footerCommentCount.textContent) + 1;
                }
            };
        
            commentSection.appendChild(commentInput);
            commentSection.appendChild(submitComment);
        }

        function sharePost() {
            alert('Post shared!');
        }

        function addPost() {
            const postText = document.getElementById('postText').value;
            const postImage = document.getElementById('fileInput').files[0];
            const postsContainer = document.getElementById('postsContainer');

            if (postText.trim() !== '' || postImage) {
                const postId = `post-${Date.now()}`; // Generate a unique ID for the post
                const newPost = document.createElement('div');
                newPost.className = 'post';
                newPost.setAttribute('data-post-id', postId);
                newPost.innerHTML = `
                    <div class='post-header'>
                        <div class='user-info'>
                            <img src="user.png" alt="User Icon" width='40'>
                            <div>
                                <strong>${userName}</strong><br>
                                <small>Just now</small>
                            </div>
                        </div>
                        <small>Posted just now</small>
                    </div>
                    <div class='post-content'>
                        <p>${postText}</p>
                        ${postImage ? `<div class='post-images'><img src='${URL.createObjectURL(postImage)}' alt='Post Image'></div>` : ''}
                    </div>
                    <div class="post-footer">
                        <span><span class="footer-heart-count">0</span> hearts</span>
                        <span><span class="footer-comment-count">0</span> comments</span>
                    </div>
                    <div class='post-actions'>
                        <button onclick='heartPost(this)'>
                            <img src="heart.png" alt="Heart Icon"> <span class='heart-count'>0</span>Heart</button>
                        </button>
                        <button onclick='commentPost(this)'>
                            <img src="comment.png" alt="Comment Icon">Comment</button>
                        </button>
                        <button onclick='sharePost()'>
                            <img src="share.png" alt="Share Icon">Share</button>
                        </button>
                    </div>
                    <div class='comment-section'></div>
                `;
                postsContainer.prepend(newPost);
                document.getElementById('postText').value = '';
                document.getElementById('fileInput').value = '';
            } else {
                alert('Post cannot be empty');
            }
        }
     
    </script>
