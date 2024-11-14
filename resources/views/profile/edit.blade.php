<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    h2 {
      margin-bottom: 20px;
      color: #333;
    }
    .input-container {
      margin-bottom: 20px;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      font-size: 16px;
    }
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #007BFF;
      outline: none;
    }
    .text-danger {
      color: #ff4d4d;
      font-size: 14px;
      margin-top: 5px;
    }
    .success-message,
    .error-message {
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 4px;
      font-size: 16px;
    }
    .success-message {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }
    .error-message {
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
      margin-top: 10px;
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
    .delete-account {
      background-color: #dc3545;
    }
    .delete-account:hover {
      background-color: #c82333;
    }
    @media (max-width: 600px) {
      .container {
        padding: 25px;
      }
    }  
  </style>
</head>
<body>
  <section>
    <div class="container">
      <center><h2>Edit Profile</h2></center><br>

      <!-- Personal Information Form -->
      <form id="personalInfoForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <div class="input-container">
          <input type="text" name="username" value="{{ auth()->user()->username }}" placeholder="Username" required>
          @error('username')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-container">
          <input type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Email" required>
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-container">
          <input type="file" name="profile_image" accept="image/*">
          @error('profile_image')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit">Save Information</button>
      </form>

      <!-- Password Change Form -->
      <form id="passwordForm" method="POST" action="{{ route('password.update') }}" style="margin-top: 20px;">
        @csrf
        @method('PUT')

        <div class="input-container">
          <input type="password" name="current_password" placeholder="Current Password" required>
          @error('current_password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-container">
          <input type="password" name="new_password" placeholder="New Password (optional)">
          @error('new_password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="input-container">
          <input type="password" name="new_password_confirmation" placeholder="Confirm New Password">
          @error('new_password_confirmation')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="password-mismatch" id="passwordMismatchMessage" style="display: none;">
          Passwords do not match.
        </div>

        <button type="submit">Change Password</button>
      </form>

      <!-- Account Deletion Form -->
      <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}" style="margin-top: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-account" onclick="return confirmDeletion()">Delete Account</button>
      </form>
    </div>
  </section>
  <script>
    // Password mismatch validation
    document.getElementById('passwordForm').addEventListener('submit', function(event) {
      const newPassword = document.querySelector('input[name="new_password"]').value;
      const newPasswordConfirmation = document.querySelector('input[name="new_password_confirmation"]').value;

      if (newPassword !== newPasswordConfirmation) {
        event.preventDefault();
        document.getElementById('passwordMismatchMessage').style.display = 'block';
      }
    });

    // Confirm account deletion
    function confirmDeletion() {
      return confirm('Are you sure you want to delete your account? This action cannot be undone.');
    }
  </script>
</body>
</html>
