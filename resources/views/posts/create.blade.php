<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- For back icon -->
    <style>
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative; /* For positioning the back icon */
        }

        .back-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 20px;
            color: #007bff;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
<br>
    <br>
    <br>
    <div class="main-container">
        <i class="fas fa-arrow-left back-icon" onclick="goBack()"></i>
        <center><h2 class="text-center" style="margin-bottom: 20px;">Create a New Post</h2></center><br>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <textarea name="content" rows="4" cols="77" class="form-control" placeholder="Write your post content here..." required style="resize: none; padding: 10px; border-radius: 5px; border: 1px solid #ced4da;"></textarea>
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control-file" style="border-radius: 5px; padding: 5px;">
            </div>
            <br>
            <center><div class="text-center">
                <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius: 5px;">Create Post</button>
            </div></center>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back(); // Navigate to the previous page
        }
    </script>
</body>
</html>
