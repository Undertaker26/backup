    function toggleContent(postId) {
        const shortContent = document.querySelector(`#content-${postId} .short-content`);
        const fullContent = document.querySelector(`#content-${postId} .full-content`);
        const link = document.querySelector(`#content-${postId} .see-more-link`);

        if (shortContent.classList.contains('d-none')) {
            shortContent.classList.remove('d-none');
            fullContent.classList.add('d-none');
            link.textContent = 'Read More';
        } else {
            shortContent.classList.add('d-none');
            fullContent.classList.remove('d-none');
            link.textContent = 'Show Less';
        }
    }

    function toggleCommentBox(postId) {
        const commentBox = document.querySelector(`#comment-box-${postId}`);
        commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';
    }

    function replyToComment(username, commentId) {
        const replyBox = document.querySelector(`#reply-box-${commentId}`);
        replyBox.style.display = replyBox.style.display === 'none' ? 'block' : 'none';
        document.querySelector(`#parent-id-${commentId}`).value = commentId;
    }

    function showAllComments(postId) {
        document.querySelectorAll(`#postsContainer .hidden-comment`).forEach(comment => {
            comment.classList.remove('d-none');
        });
        document.querySelector(`#postsContainer .btn-link`).style.display = 'none';
    }
