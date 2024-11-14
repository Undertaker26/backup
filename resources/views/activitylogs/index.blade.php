<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar h4 {
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
            flex: 1;
        }
        .activity-log {
            margin-top: 20px;
        }
        .activity-log .card {
            margin-bottom: 15px;
        }
        .activity-log .date-header {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 20px;
        }
        .log-details {
            font-size: 0.9rem;
        }
        .log-time {
            text-align: right;
            font-size: 0.8rem;
            color: gray;
        }
        .profile {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .post-link {
            font-weight: bold;
            text-decoration: none;
            color: #007bff;
        }
        .post-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Activity Log</h4>
        <a href="{{ route('activitylogs', ['type' => 'login']) }}">Login Activity</a>
        <a href="{{ route('activitylogs', ['type' => 'post']) }}">Post Activity</a>
        <a href="{{ route('activitylogs', ['type' => 'article']) }}">Articles Activity</a>
    </div>

    <div class="main-content">
        <div class="container activity-log">
            <h3>{{ ucfirst($type) }} Activities</h3>

            <!-- Group logs by date -->
            @foreach ($logs->groupBy(function($log) {
                return $log->created_at->format('F j, Y'); // Group logs by date (e.g., September 14, 2024)
            }) as $date => $dailyLogs)
                <div class="date-header">{{ $date }}</div>

                <!-- Loop through logs for the specific date -->
                @foreach ($dailyLogs as $log)
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <!-- User's profile picture logic -->
                            @php
                                $profileImageUrl = $log->user->profile_image_url;
                            @endphp
                            <a href="{{ route('profile.show', $log->user) }}">
                                <img src="{{ asset($profileImageUrl ? 'storage/' . $profileImageUrl : 'profile.png') }}" alt="Profile Image" class="profile me-3">
                            </a>

                            <div>
                                <strong>{{ $log->user->username }}</strong> was logged in on {{ $log->activity_type }}.
                                <div class="log-details">
                                    <!-- Bold clickable post title that links to the post -->
                                    @if ($log->post)
                                        <a href="{{ route('posts.show', $log->post->id) }}" class="post-link">
                                            {{ $log->post->title }}
                                        </a>
                                    @else
                                        <span>No post available</span>
                                    @endif
                                    <br>
                                    {{ $log->description }}<br>
                                    Created: {{ $log->created_at->format('M d, Y, h:i A') }}<br>
                                    IP address: {{ $log->ip_address }} | Browser: {{ $log->user_agent }}
                                </div>
                            </div>
                            <div class="log-time ms-auto">{{ $log->created_at->format('h:i A') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforeach

            <!-- Pagination Links (if needed) -->
            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
