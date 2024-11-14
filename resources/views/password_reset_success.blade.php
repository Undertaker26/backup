<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Success</title>
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
            font-size: 24px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 14px;
            margin-bottom: 40px;
            color: #555;
        }
        .button-group {
            text-align: center;
        }
        .button-group a {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .button-group a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Success!</h1>
        <p>Your password has been successfully reset. You can now log in with your new password.</p>
        <div class="button-group">
            <a href="{{ route('login') }}">Go to Login</a>
        </div>
    </div>
</body>
</html>
