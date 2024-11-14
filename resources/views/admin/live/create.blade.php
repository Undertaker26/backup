@extends('admin.dashboard')

@section('title', 'Manage Live Stream')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <h1 class="text-center">Manage Live Stream</h1>
            <br>

            @if (session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                <br>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.live.store') }}" method="POST" class="update-form">
                @csrf
                <div class="form-group text-center">
                    <label for="video_url" class="form-label">Video URL:</label>
                    <input type="text" id="video_url" name="video_url" class="form-control" placeholder="Enter the video URL" required>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <br>

            @if ($liveVideo)
                <div class="live-preview text-center">
                    <div id="live-video" class="live-video">
                        <iframe src="{{ $liveVideo->video_url }}" allowfullscreen></iframe>
                    </div>
                </div>
                <form action="{{ route('admin.live.end') }}" method="POST" class="text-center mt-3">
                    @csrf
                    <button type="submit" class="btn btn-danger">End Live Stream</button>
                </form>
            @else
                <p class="text-center mt-4">No live video is currently available.</p>
            @endif
        </div>

        <style>
            .main-content {
                margin-left: 290px;
            }

            .update-form {
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
                text-align: center;
            }

            .form-label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            .form-control {
                display: inline-block;
                width: calc(100% - 24px);
                padding: 12px;
                border-radius: 5px;
                border: 1px solid #ced4da;
                box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            .form-control:focus {
                border-color: #007bff;
                box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
                outline: none;
            }

            .live-preview {
                position: relative;
                margin-top: 20px;
            }

            .live-video {
                margin-top: 20px;
            }

            .live-video iframe {
                width: 100%;
                height: 500px;
                border: none;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #00408d;
            }

            .btn-danger {
                background-color: #dc3545;
                border-color: #dc3545;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .btn-danger:hover {
                background-color: #c82333;
                border-color: #bd2130;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border-color: #c3e6cb;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border-color: #f5c6cb;
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 20px;
            }
        </style>
    </div>
</div>
@endsection
