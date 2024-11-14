<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo2.png"  type="image/x-icon"/>
    <title>The University Scribe</title>

    <style>
        /* Custom Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            
        }

        /* Header with Logo */
        .header {
            background-color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-brand .logo {
            height: 100px;
        
        }

        /* Navigation Bar */
        .navbar {
            background-color: #004d40; /* Dark green */
            padding: 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar-menu li {
            position: relative;
            margin: 0 10px;
        }

        .navbar-menu li a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            display: block;
            text-align: center;
            transition: background-color 0.3s ease, border-bottom 0.3s ease;
        }

        .navbar-menu li a:hover {
            background-color: #003d33; /* Slightly darker green */
        }

        /* Dropdown menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #004d40; /* Dark green */
            top: 100%;
            left: 0;
            list-style-type: none;
            margin: 0;
            padding: 0;
            min-width: 120px;
            z-index: 1000;
        }

        .main-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-height: 600px;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: white;
        } 

      
    </style>
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>

    @include('layouts.footer')
</body>
</html>
