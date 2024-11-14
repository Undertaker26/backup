<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>

    
        body {
            /* font-family: 'Arial', sans-serif; */
            font-family: 'Montserrat', 'tMontserrat light';
            background-color: #red;
            margin: 0;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #174E46;
            padding-top: 20px;
            color: white;
        }
        .pin{
            padding-left:600px;
        }

        .sidebar a {
            padding: 15px 20px;
            text-decoration: none;
            font-size: 16px;
            color: white;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: gray;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .form-container label {
            display: block;
            margin-top: 10px;
        }

        .form-container input,
        .form-container select,
        .form-container textarea,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
    
</head>
<body>
    @yield('content')
</body>
</html>
