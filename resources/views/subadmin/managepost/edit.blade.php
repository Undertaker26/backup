<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- For back icon -->
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
        .input-container {
            margin-bottom: 20px;
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
        .success-message,
        .error-message,
        .password-mismatch {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 16px;
            display: none; /* Initially hidden */
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            animation: fadeInOut 3s ease-out;
        }
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .password-mismatch {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }
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
    <center><h1>Edit Post</h1></center>
    <div class="card">
        <div class="card-body">

        <form action="{{ route('subadmin.managepost.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

          <!-- <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control"> -->
                @if($post->image)
                    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="100" class="mt-2">
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            <!-- </div>  -->

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
    <script>
        function goBack() {
        window.history.back(); // Navigate to the previous page
    }

</script>
