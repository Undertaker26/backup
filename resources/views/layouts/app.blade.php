<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo2.png"  type="image/x-icon"/>
    <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

    body {
        font-family: 'Montserrat', 'tMontserrat light';
    }
    body {
            /* font-family: Arial, sans-serif; */
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #174E46;
            color: white;
            padding: 3px 0;
            text-align: start;
        }
        .header h1 {
            margin: 0;
            color: white;
            text-align: center;
            padding:10px;
        }
        .navbar {
            display: flex;
            justify-content: space-around;
            background-color:#EAEAEA;
            padding: 10px 0;
            flex-wrap: wrap;
        }
        .navbar a {
            color: black;
            text-decoration: none;
            padding: 10px;
        }
        .navbar a:hover {
            background: gray;
            transition: 0.5s;
        }
        .main-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .post-input {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 19px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #e0e0e0;
        }
        .post-input img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .post-input input[type="text"] {
            flex: 1;
            padding: 5px;
            border: none;
            outline: none;
            margin:5px;
            border-radius: 20px;
            background-color: white;
        }
        .post-input button, .post-input label {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
            .post-input button, {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            }

        
        .post-input button:hover, .post-input label:hover {
            background-color: #0056b3;
        }
        .post-input .live-video {
            background-color: red;
        }
        .post {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .post-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .post-header img {
            border-radius: 50%;
            margin-right: 10px;
        }
        .post-header .user-info {
            display: flex;
            align-items: center;
        }
        .post-content {
            margin-bottom: 10px;
        }
        .post-images img {
            width: 100%;
            border-radius: 5px;
        }
        .post-actions {
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .post-actions button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
        .post-actions button img {
            width: 16px;
            height: 16px;
        }
        .post-actions button:hover {
            text-decoration: underline;
        }
        .comment-section {
            border-top: 1px solid #ddd;
            padding: 10px 0;
        }
        .comment {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .main-content {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .container {
            max-width: 935px;
            margin: 20px auto;
            background-color: white;
            
            
        }
        .main-article {
            width: 65%;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 18px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .main-article img {
            width: 100%;
            border-radius: 5px;
        }
        .sidebar {
            width: 30%;
            display: flex;
            flex-direction: column;
        }
        .sidebar-article {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .sidebar-article img {
            width: 100%;
            border-radius: 5px;
        }
        .latest, .articles {
            margin-top: 20px;
        }
        .latest h2, .articles h2 {
            margin: 0 0 10px 0;
        }
        .news-item {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .news-item img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .news-item .content {
            flex: 1;
        }
        .news-item .content h3 {
            margin: 0 0 5px 0;
        }
        .news-item .content p {
            margin: 0 0 10px 0;
        }
        .news-item .content span {
            color: #777;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .load-more {
            background-color: #174E46;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .load-more:hover {
            background-color: #11DAC2;
        }
        .comment img {
            border-radius: 50%;
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
 
        .post-footer {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .post-footer span {
            font-size: 12px;
        }

        

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: center;
            }
            .search-container {
                justify-content: center;
                margin-top: 10px;
            }
        }
        .event {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .event-header h2 {
            margin: 0;
            font-size: 20px;
        }
        .event-header button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .event-header button:hover {
            background-color: #0056b3;
        }
        .event-details {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        
.cartoons-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 1em;
}

.cartoon {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    max-width: calc(33.333% - 1em);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.cartoon img {
    width: 100%;
    height: auto;
}

.cartoon-info {
    padding: 10px;
}

.cartoon-info .title {
    font-weight: bold;
    margin-bottom: 5px;
}

.cartoon-info .cartoonist {
    color: #555;
}
        
        .opinions-grid {
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        .opinion {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            padding: 1em;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .opinion img {
            width: 60px;
            height: 60px;
            border-radius: 50px;
            margin-right: 1em;
            object-fit: cover;
        }

        .opinion h3 {
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 0;
        }

        .opinion p {
            color: #555;
            margin: 0;
        }
        .navbar a.active {
            background-color: #174E46;
            color: white;
        }
         .header a {
            text-decoration: none;
            color: inherit; /* Maintain the current text color */
        }
  .navbar {
            display: flex;
            justify-content: space-around;
            background-color: #CAC7C7;
            padding: 10px 0;
            flex-wrap: wrap;
            align-items: center; /* Ensure items align center vertically */
        }

        .navbar a, .navbar .dropdown {
            color: black;
            text-decoration: none;
            padding: 10px;
            position: relative; /* Ensure dropdown positioning is relative to the navbar item */
        }

        .navbar a:hover, .navbar .dropdown:hover > .dropdown-content {
            background: gray;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            top: 100%; /* Position it below the navbar item */
            left: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            opacity: 0; /* Start hidden */
            transform: translateY(-10px); /* Start slightly above */
            transition: opacity 0.3s ease, transform 0.3s ease; /* Smooth transitions */
        }

        .navbar .dropdown-content a {
            color: black;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .navbar .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1; /* Fully visible */
            transform: translateY(0); /* Move to original position */
        }

        .navbar .dropdown span {
            cursor: pointer; /* Indicate that the element is interactive */
        }

   
  
        .header {
    background-color: #f8f9fa; /* Background color of the header */
    padding: 10px 20px; /* Space around the logo */
    text-align: start; /* Center the logo */
}

.header .logo {
    max-width: 150px; /* Adjust the maximum width of the logo */
    height: 50px; /* Maintain aspect ratio */
    display: inline-block; /* Align logo in the middle of the header */
}
    </style>
    </head>
<body>
<div class="header">
        <a href="{{ url('articles') }}">
            <img src="logo.png" alt="Scribe Logo" class="logo">
            <!-- <span>Scribe Entertainment</span> -->
        </a>
    </div>

        </div>
    </div>
    <div class="navbar">
    <a href="{{ route('posts.index') }}" class="{{ Request::routeIs('posts.index') ? 'active' : '' }}">Posts</a>
        <!-- <a href="{{ route('post') }}" class="<?php echo (Request::is('post') ? 'active' : ''); ?>">Posts</a> -->
        <a href="{{ route('articles') }}" class="{{ Request::routeIs('articles') ? 'active' : '' }}">News</a>
        <a href="{{ route('sport') }}" class="<?php echo (Request::is('sport') ? 'active' : ''); ?>">Sports</a>
        <a href="{{ route('scitech') }}" class="<?php echo (Request::is('scitech') ? 'active' : ''); ?>">Sci-Tech</a>
        <a href="{{ route('cartoonist') }}" class="<?php echo (Request::is('cartoonist') ? 'active' : ''); ?>">Cartoonist</a>
        <a href="{{ route('opinion') }}" class="<?php echo (Request::is('opinion') ? 'active' : ''); ?>">Opinion</a>
        <a href="{{ route('events') }}" class="{{ Request::routeIs('events') ? 'active' : '' }}">Events</a>
        <!-- <a href="{{ route('video') }}" class="<?php echo (Request::is('video') ? 'active' : ''); ?>">Videos</a> -->
        <!-- <a href="{{ route('album') }}" class="<?php echo (Request::is('album') ? 'active' : ''); ?>">Album</a> -->
        <a href="{{ route('gallery.show') }}" class="{{ Request::routeIs('gallery.show') ? 'active' : '' }}">Gallery</a>
        <a href="{{ route('live.show') }}" class="{{ Request::routeIs('live.show') ? 'active' : '' }}">Live</a>
        <a href="{{ route('organation') }}" class="{{ Request::routeIs('organation') ? 'active' : '' }}">Chart</a>
        <a href="{{ route('about') }}" class="<?php echo (Request::is('about') ? 'active' : ''); ?>">About</a>
        <!-- <a href="{{ route('profile.edit') }}" class="<?php echo (Request::is('profile.edit') ? 'active' : ''); ?>">Profile</a>
        <a href="{{ route('logout') }}" class="<?php echo (Request::is('logout') ? 'active' : ''); ?>">Logout</a> -->
        <div class="user-profile">
            <span>{{ Auth::user()->username }}</span>
            <span class="arrow">&#9662;</span>
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}">Edit Profile</a>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
    </div>
    </div>



   
     <div class="container mt-5">
        @yield('content')
    </div>
</body>
</html>