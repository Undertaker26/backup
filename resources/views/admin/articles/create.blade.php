@extends('layouts.admin')
<title>Insert  New Articles</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- For back icon -->

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        margin-left: 100px;
    }

    .card {
        border: 0;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #e0e0e0;
        padding: 16px 24px;
    }

    .card-body {
        padding: 24px;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control {
        border-radius: 4px;
        border: 1px solid #e0e0e0;
        box-shadow: none;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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

    .back-icon {
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 20px;
        color: #007BFF;
        cursor: pointer;
    }
</style>

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <i class="fas fa-arrow-left back-icon" onclick="goBack()"></i>
        <div class="card-header">
            <center><h1 class="h3 mb-0">Insert New Article</h1></center>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="title" required>
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" id="content" rows="5" required></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <div class="form-group mb-3">
                    <label for="display_location" class="form-label">Display Location</label>
                    <select name="display_location" class="form-control" id="display_location" required>
                        <option value="main">Main</option>
                        <option value="sidebar">Sidebar</option>
                        <option value="latest">Latest</option>
                    </select>
                </div>
                <br>
                <center><button type="submit" class="btn btn-primary">Publish Now</button></center>
            </form>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back(); // Navigate to the previous page
    }
</script>
@endsection
