@extends('layouts.app')

<title>Scribe Entertainment</title>

@section('title', 'Index')

@section('content')
    <div class="main-container">
      
        <div id="postsContainer">

        <center><h1 class="display-5 fw-bold">Hi, {{ auth()->user()->username }}</h1>
        <p class="col-md-8 fs-4">Welcome to Scribe Entertainment.</p>
        <br><br>

      </div>
      
            <!-- Sample Post -->
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
     
@endsection