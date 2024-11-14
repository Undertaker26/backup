@extends('admin.dashboard')
<title>Organization Chart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4"> 
        <div class="card-body">
            <!-- Row for heading and button alignment -->
            <div class="row mb-3">
                <div class="col">
                    <!-- Heading aligned to the left -->
                    <h2>Manage Organizations</h2>
                </div>
                <div class="col text-right">
                    <!-- Button aligned to the right -->
                    <a href="{{ route('admin.organ_chart.create') }}" class="btn btn-primary">Add Organization</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Date Hired</th>
                        <!-- <th>Parent Organization</th> -->
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizations as $organization)
                        <tr>
                            <td>{{ $organization->name }}</td>
                            <td>{{ $organization->position }}</td>
                            <td>{{ $organization->created_at->format('m-d-Y') }}</td>
                            <!-- <td>{{ $organization->parent ? $organization->parent->name : 'None' }}</td> -->
                            <td>{{ $organization->category }}</td>
                            <td>
                            <a href="{{ route('admin.organ_chart.edit', $organization->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.organ_chart.destroy', $organization->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
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
    </div>
</div>

<style>
    .text-wrap {
        white-space: normal; /* Allow text to wrap */
        word-wrap: break-word; /* Break long words if needed */
    }

    td {
        max-width: 200px; /* Optional: set a max width for table cells */
        overflow: hidden; /* Hide overflowed content */
    }

    .main-content {
        margin-left: 290px;
    }

    .card {
        margin-top: 20px;
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
</style>
@endsection
