@extends('admin.dashboard')
<title>Post Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


@section('title', 'Manage Post')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4"> 
        <div class="card-body">
            <!-- Row for heading and button alignment -->
            <div class="row mb-3">
                <div class="col">
                    <!-- Heading aligned to the left -->
                    <h2>All Posts</h2>
                </div>
                <div class="col text-right">
                    <!-- Button aligned to the right -->
                    <a href="{{ route('admin.managepost.create') }}" class="btn btn-primary">Create New Post</a>
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
                        <!-- <th>ID</th> -->
                        <th>User_ID</th>
                        <th>Username</th>
                        <th>Content</th>
                        <!-- <th>Image</th> -->
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <!-- <td>{{ $post->id }}</td> -->
                            <td>{{ $post->user_id }}</td>
                            <td>{{ $post->username }}</td>
                            <td class="text-wrap">{{ Str::limit($post->content, 100) }}</td>
                            <!-- <td>
                                @if($post->image)
                                    <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" width="100">
                                @endif
                            </td> -->
                            <td>{{ $post->created_at->format('m-d-Y H:i:s') }}</td>
                            <td>
                            <a href="{{ route('admin.managepost.edit', $post->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.managepost.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
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
