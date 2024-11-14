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
            margin-top: 20px;
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
    <center><h1>Edit User</h1></center>
    <div class="card">
        <div class="card-body">
            <form id="userForm" action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Success Message -->
                <div id="success-message" class="success-message">
                    Successfully updated!
                </div>

                <!-- Error Message -->
                @if (session('error'))
                    <div class="error-message">{{ session('error') }}</div>
                @endif

                <div class="mb-3">
                    <label for="student_id" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" value="{{ $user->student_id }}"  required >
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}"  required  >
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">Course</label>
                    <select class="form-control @error('course') is-invalid @enderror" name="course" id="course" required>
                        <option value="" selected disabled>Select Course</option>
                        <option value="BSIT" {{ old('course', $user->course) == 'BSIT' ? 'selected' : '' }}>Bachelor of Science in Information Technology</option>
                        <option value="BSCRIM" {{ old('course', $user->course) == 'BSCRIM' ? 'selected' : '' }}>Bachelor of Science in Criminology</option>
                        <option value="BSPHAR" {{ old('course', $user->course) == 'BSPHAR' ? 'selected' : '' }}>Bachelor of Science in Pharmacy</option>
                        <option value="BAComm" {{ old('course', $user->course) == 'BAComm' ? 'selected' : '' }}>Bachelor of Arts in Communication</option>
                        <option value="BSMid" {{ old('course', $user->course) == 'BSMid' ? 'selected' : '' }}>Bachelor of Science in Midwifery</option>
                        <option value="BLIS" {{ old('course', $user->course) == 'BLIS' ? 'selected' : '' }}>Bachelor of Library & Information Science</option>
                        <option value="BSHM" {{ old('course', $user->course) == 'BSHM' ? 'selected' : '' }}>Bachelor of Science in Hospitality Management</option>
                        <option value="BSTM" {{ old('course', $user->course) == 'BSTM' ? 'selected' : '' }}>Bachelor of Science in Tourism Management</option>
                        <option value="BSArch" {{ old('course', $user->course) == 'BSArch' ? 'selected' : '' }}>Bachelor of Science in Architecture</option>
                        <option value="BSCE" {{ old('course', $user->course) == 'BSCE' ? 'selected' : '' }}>Bachelor of Science in Civil Engineering</option>
                        <option value="BSCpE" {{ old('course', $user->course) == 'BSCpE' ? 'selected' : '' }}>Bachelor of Science in Computer Engineering</option>
                        <option value="BSEE" {{ old('course', $user->course) == 'BSEE' ? 'selected' : '' }}>Bachelor of Science in Electrical Engineering</option>
                        <option value="BSECE" {{ old('course', $user->course) == 'BSECE' ? 'selected' : '' }}>Bachelor of Science in Electronics Engineering</option>
                        <option value="BSPsy" {{ old('course', $user->course) == 'BSPsy' ? 'selected' : '' }}>Bachelor of Science in Psychology</option>
                        <option value="BSSW" {{ old('course', $user->course) == 'BSSW' ? 'selected' : '' }}>Bachelor of Science in Social Work</option>
                        <option value="BCAEd" {{ old('course', $user->course) == 'BCAEd' ? 'selected' : '' }}>Bachelor of Culture and Arts Education</option>
                        <option value="BECEd" {{ old('course', $user->course) == 'BECEd' ? 'selected' : '' }}>Bachelor of Early Childhood Education</option>
                        <option value="BEEd" {{ old('course', $user->course) == 'BEEd' ? 'selected' : '' }}>Bachelor of Elementary Education</option>
                        <option value="BPEd" {{ old('course', $user->course) == 'BPEd' ? 'selected' : '' }}>Bachelor of Physical Education</option>
                        <option value="BSEd" {{ old('course', $user->course) == 'BSEd' ? 'selected' : '' }}>Bachelor of Secondary Education</option>
                        <option value="BSNEd" {{ old('course', $user->course) == 'BSNEd' ? 'selected' : '' }}>Bachelor of Special Needs Education</option>
                        <option value="BSA" {{ old('course', $user->course) == 'BSA' ? 'selected' : '' }}>Bachelor of Science in Accountancy</option>
                        <option value="BSBA" {{ old('course', $user->course) == 'BSBA' ? 'selected' : '' }}>Bachelor of Science in Business Administration</option>
                        <option value="BSMA" {{ old('course', $user->course) == 'BSMA' ? 'selected' : '' }}>Bachelor of Science in Management Accounting</option>
                        <option value="BSOA" {{ old('course', $user->course) == 'BSOA' ? 'selected' : '' }}>Bachelor of Science in Office Administration</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="" selected disabled>Select Status</option>
                        <option value="current_student" {{ old('status', $user->status) == 'current_student' ? 'selected' : '' }}>Current Student</option>
                        <option value="alumni" {{ old('status', $user->status) == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"  required >
                </div>
                <div class="mb-3">
                    <label for="usertype" class="form-label">User Type</label>
                    <select class="form-select" id="usertype" name="usertype" required>
                        <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->usertype == 'subadmin' ? 'selected' : '' }}>Sub Admin</option>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" onclick="showSuccessMessage()">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    function goBack() {
        window.history.back(); // Navigate to the previous page
    }

    function showSuccessMessage() {
        // Show success message
        var successMessage = document.getElementById('success-message');
        successMessage.style.display = 'block';
    }
    
</script>

</body>
</html>