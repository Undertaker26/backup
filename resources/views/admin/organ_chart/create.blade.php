<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Member</title>
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
        .form-group {
            margin-bottom: 20px; /* Add space between form groups */
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
            margin-bottom: 20px; /* Add space below the button */
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
        <center><h1>Add Organization Member</h1></center>
        <form action="{{ route('admin.organ_chart.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="position">Position</label>
                <select name="position" id="position" class="form-control" required>
                    <option value="">Select Position</option>
                    @foreach($positions as $category => $posList)
                        <optgroup label="{{ $category }}">
                            @foreach($posList as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name (optional)</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="parent_id">Parent Organization</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">None</option>
                    @foreach($organizations as $org)
                        <option value="{{ $org->id }}">{{ $org->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control" required>
                    <option value="">Select Category</option>
                    <option value="BOARDS OF REGENT">BOARDS OF REGENT</option>
                    <option value="UNIVERSITY OF SCRIBE">UNIVERSITY OF SCRIBE</option>
                    <option value="STAFF">STAFF</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>

    <script>
        function goBack() {
            window.history.back(); // Navigate to the previous page
        }
    </script>
</body>
</html>
