<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo2.png"  type="image/x-icon"/>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .container h1 {
            font-size: 23px;
            color: #007bff;
            padding-bottom: 10px;
        }
        .container p {
            font-size: 14px;
            margin-bottom: 40px;
            color: #555;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .button-group {
            text-align: center;
        }
        .button-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        .button-group button:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>To reset your password, please enter your email address below. We will send you a link to reset your password.</p>
        @if (session('success'))
            <div class="message success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('forget.password.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <!-- <label class="form-label" for="email">Email address</label> -->
                <input type="email" id="email" class="form-control" name="email" placeholder="Enter your email address" required>
            </div>
            <br>
            <div class="button-group">
                <button type="submit">Send Reset Link</button>
            </div>
        </form>
    </div>
</body>
</html>
