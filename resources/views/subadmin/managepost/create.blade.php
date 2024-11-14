<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Post</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- For icons -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            position: relative;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .form-control,
        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #007BFF;
            outline: none;
        }
        .text-danger {
            color: #ff4d4d;
            font-size: 14px;
            margin-top: 5px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 15px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 20px;
            color: #007BFF;
            cursor: pointer;
        }
        .preview-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .preview-container img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .post-header h3 {
            margin: 0;
            font-size: 16px;
            color: #333;
        }
        .post-content {
            margin-bottom: 10px;
        }
        .icons-container {
            display: flex;
            justify-content: space-around;
        }
        .icons-container i {
            font-size: 24px;
            cursor: pointer;
            color: #007BFF;
        }
        .icons-container i:hover {
            color: #0056b3;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>

<div class="container">
    <i class="fas fa-arrow-left back-icon" onclick="goBack()"></i>
    <center><h1>Create New Post</h1></center>
    <div class="card">
        <div class="card-body">

            <form id="postForm" action="{{ route('subadmin.managepost.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" class="form-control" rows="5" oninput="updatePreview()">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control" onchange="updatePreview()">
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
<br>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>

            <div id="previewContainer" class="preview-container">
            <center><h4>Post Preview</h4></center>

                <div class="post-header">
                    <!-- <img src="https://via.placeholder.com/40" alt="User Avatar" id="previewAvatar"> Placeholder for user avatar -->
                    <h3 id="previewName"></h3>
                </div>
                <div id="previewContent" class="post-content"></div>
                <div id="previewImage"></div>
                <!-- <div class="icons-container">
                    <i class="fas fa-heart" title="Like"></i>
                    <i class="fas fa-comment" title="Comment"></i>
                    <i class="fas fa-share" title="Share"></i>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back(); // Navigate to the previous page
    }

    function updatePreview() {
        const content = document.getElementById('content').value;
        const previewContent = document.getElementById('previewContent');
        previewContent.innerHTML = `<p>${content}</p>`;

        const imageInput = document.getElementById('image');
        const previewImage = document.getElementById('previewImage');

        if (imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.innerHTML = `<img src="${e.target.result}" alt="Preview Image">`;
            };
            reader.readAsDataURL(imageInput.files[0]);
        } else {
            previewImage.innerHTML = '';
        }

        // Automatically set the preview name
        const name = "{{ Auth::user()->username }}"; // Using Laravel Blade to insert the logged-in user's name
        const previewName = document.getElementById('previewName');
        previewName.innerHTML = `<strong>${name}</strong>`;
    }

    // Initialize preview with default values
    updatePreview();
</script>

</body>
</html>
