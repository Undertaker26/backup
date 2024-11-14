<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Event</title>
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
    <center><h1>Create New Event</h1></center>
    <div class="card">
        <div class="card-body">
    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>
<script>
        function goBack() {
        window.history.back(); // Navigate to the previous page
    }
</script>
