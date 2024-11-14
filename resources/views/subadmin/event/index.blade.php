@extends('subadmin.subdashboard')
<title>Event Management  | Scribe Entertainment</title>

@section('title', 'Manage Events')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <!-- Container for heading and button -->
            <div class="d-flex justify-content-between mb-3">
                <h2 class="mb-0">Manage Events</h2>
                <a href="{{ route('subadmin.event.create') }}" class="btn btn-primary">Create New Event</a>
            </div>

            <!-- Sorting buttons -->
            <div class="d-flex justify-content-end mb-3">
                <form method="GET" action="{{ route('subadmin.event.index') }}">
                    <div class="btn-group" role="group" aria-label="Sort Events">
                        <a href="{{ route('subadmin.event.index', ['sort' => 'latest_date']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'latest_date' ? 'active' : '' }}">Latest Date</a>
                        <a href="{{ route('subadmin.event.index', ['sort' => 'oldest_date']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'oldest_date' ? 'active' : '' }}">Oldest Date</a>
                        <a href="{{ route('subadmin.event.index', ['sort' => 'a_z']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'a_z' ? 'active' : '' }}">A-Z</a>
                        <a href="{{ route('subadmin.event.index', ['sort' => 'z_a']) }}" class="btn btn-sort btn-sm {{ request('sort') == 'z_a' ? 'active' : '' }}">Z-A</a>
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
                                <a href="{{ route('subadmin.event.edit', $event) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('subadmin.event.destroy', $event) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
                margin-right: 5px;
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
