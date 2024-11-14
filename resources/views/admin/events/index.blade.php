@extends('admin.dashboard')
<title>Event Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


@section('title', 'Manage Events')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <!-- Container for heading and button -->
            <div class="d-flex justify-content-between mb-3">
                <h2 class="mb-0">Manage Events</h2>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create New Event</a>
            </div>

            <!-- Sorting buttons -->
            <div class="d-flex justify-content-end mb-3">
                <form method="GET" action="{{ route('admin.events.index') }}">
                    <div class="btn-group" role="group" aria-label="Sort Events">
                        <a href="{{ route('admin.events.index', ['sort' => 'latest_date']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'latest_date' ? 'active' : '' }}">Latest Date</a>
                        <a href="{{ route('admin.events.index', ['sort' => 'oldest_date']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'oldest_date' ? 'active' : '' }}">Oldest Date</a>
                        <a href="{{ route('admin.events.index', ['sort' => 'a_z']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'a_z' ? 'active' : '' }}">A-Z</a>
                        <a href="{{ route('admin.events.index', ['sort' => 'z_a']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'z_a' ? 'active' : '' }}">Z-A</a>
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->start_time->format('g:i A') }}</td>
                            <td>{{ $event->end_time->format('g:i A') }}</td>
                            <td>{{ $event->date->format('F j, Y') }}</td>
                            <td>
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <style>
            .text-wrap {
                white-space: normal;
                word-wrap: break-word;
            }

            td {
                max-width: 200px;
                overflow: hidden;
            }

            .main-content {
                margin-left: 290px;
                /* padding: 20px; */
            }

            .btn-primary {
                margin-top: 5px;
                margin-bottom: 15px;
            }

            .table {
                margin-top: 10px;
                font-size: 12px;
            }

                                .btn-sm {
        padding: 5px;
        font-size: 12px;
        margin-right: 5px;
    }
    .btn-warning, .btn-danger, .btn-success {
        padding: 5px 10px;
    }

            .btn-group .btn-sort {
                color: #ffffff;
                border: 1px solid #000000;
                background-color: #007bff;
            }

            .btn-group .btn-sort.active {
                background-color: #ffffff;
                color: #007bff;
            }

            .btn-group .btn-sort:not(.active):hover {
                background-color: #0056b3;
                color: #ffffff;
            }
        </style>
    </div>
</div>
@endsection
