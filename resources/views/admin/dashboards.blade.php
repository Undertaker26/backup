@extends('admin.dashboard')
<title>Admin Dashboard | Scribe Entertainment</title>

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="user-profile">
        <span class="username">{{ Auth::user()->username }}</span>
        <span class="arrow">&#9662;</span> <!-- Downward arrow character -->
        <div class="dropdown-menu">
            <a href="{{ route('admin.profile.edit') }}">Profile</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </div>

    <!-- Metrics Boxes -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                <a href="{{ route('admin.managepost.index') }}" class="h4-link">Posts</a>
                    <p class="card-text">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                <a href="{{ route('admin.articles.index') }}" class="h4-link">Articles</a>
                    <p class="card-text">{{ $totalArticles }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                <a href="{{ route('admin.users.index') }}" class="h4-link">Users</a>
                <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="logContainer">
        <div class="recent-logs">
        <h4>
        <a href="{{ route('admin.activityrecords.index') }}" class="h4-link">ACTIVITY LOG</a>
    </h4>
  <p>press the <b>Activity Log</b> to show all activities</p>


            <ul class="list-group" id="activity-list">
                @include('admin.partials.activity_logs')
            </ul>
        </div>
    </div>

    <style>
        /* Profile and dropdown */
        .user-profile {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: relative;
            font-size: 16px;
        }

        .username {
            margin-right: 8px;
        }

        .arrow {
            font-size: 16px;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            font-size: 14px;
        }

        p{
            font-size:12px;
            text-align:center;
        }
        .dropdown-menu a {
            display: block;
            font-size: 17px;
            padding: 8px 12px;
            color: #333;
            text-decoration: none;
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
        }

        .user-profile:hover .dropdown-menu {
            display: block;
        }
        .h4-link {
            font-size: 20px; /* Adjust the font size */
            color: green; /* Set the text color */
            font-weight: bold; /* Make the text bold */
            letter-spacing: 1px; /* Add letter spacing */
            text-align:center;

            text-decoration: none; /* Remove underline */
            display: inline-block; /* Make the link block-level */
            width: 100%; /* Ensure it spans the full width */
        }

        .h4-link:hover {
            color: darkgreen; /* Darker color on hover */
            text-decoration: none; /* Add underline on hover */
        }


        /* Main content */
        .main-content {
            margin-left: 290px;
            margin-top: 20px;
        }

        .card {
            margin-top: 20px;
            border-radius: 0.5rem;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #007bff;
        }

        .card-text {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Recent logs */
        .logContainer {
            margin-left: 10px;
        }

        .recent-logs {
            margin-top: 180px;
            width: 580px; /* Set a fixed width */
            overflow-y: auto; /* Add vertical scrollbar */
            padding: 15px;
            max-height:40vh;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
        }

        .recent-logs h4 {
            font-size: 1.25rem;
            margin-bottom: 15px;
            color: #007bff;
        }

        .list-group {
            padding-left: 0;
        }

        .list-group-item {
            font-size: 12px;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 0.25rem;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            transition: background-color 0.3s ease-in-out; /* Smooth background color transition */
        }

        .list-group-item:hover {
            background-color: #e9ecef;
        }

        .text-muted {
            color: #6c757d;
            font-size: 12px;
        }

        /* Button */
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Scrollbar styling */
        .recent-logs::-webkit-scrollbar {
            width: 8px;
        }

        .recent-logs::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            border-radius: 10px;
        }

        .recent-logs::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }

        .recent-logs::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchRecentActivities() {
                $.ajax({
                    url: '{{ route('admin.activity_logs') }}',
                    method: 'GET',
                    success: function (data) {
                        $('#activity-list').html(data);
                    }
                });
            }

            // Fetch recent activities every 5 seconds
            setInterval(fetchRecentActivities, 5000);
        });
    </script>
@endsection
