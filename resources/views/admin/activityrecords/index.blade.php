@extends('admin.dashboard')
<title>Admin Dashboard | Scribe Entertainment</title>

@section('content')
<div class="col-md-9 offset-md-3 main-content">

    <div class="logContainer">
        <div class="recent-logs">
            
        <h2>Activity Logs</h2><span>
        <div class="col text-right">
                    <!-- Clear All Button -->
                    <form action="{{ route('admin.activity.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all activity logs?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">Clear All</button>
                    </form>
                </div>
        <ul class="list-group" id="activity-list">
                @include('admin.partials.activity')
            </ul>
        </div>
    </div>

    <style>


        /* Main content */
        .main-content {
            margin-left: 290px;
            margin-top: 20px;
        }


        /* Recent logs */
        .logContainer {
            margin-left: 10px;
            overflow-y: auto;
        }

        .recent-logs {
            margin-top: 20px;
            height:90vh;
            max-width: 900px;
            overflow-y: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
        }

        .recent-logs h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #007bff;
        }

        .list-group {
            padding-left: 0;
        }

        .list-group-item {
            font-size: 14px;
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
        .btn-danger {
            background-color: red;
            border: none;
            padding: 10px 10px;
            font-size: 13px;
            border-radius: 0.25rem;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>


@endsection
