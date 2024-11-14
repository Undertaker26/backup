@extends('admin.dashboard')
<title>View All  Comments</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


@section('title', 'Manage Articles')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <!-- Heading aligned to the left -->
                    <h2>Comments</h2>
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
                        <th>ID</th>
                        <th>User</th>
                        <th>Reply to</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->user->username }}</td>
                        <td>{{ $comment->parent_id }}</td>
                        <td class="text-wrap">{{ censorBadWords($comment->content) }}</td>
                        <td>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>                            
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
        white-space: normal;
        word-wrap: break-word;
    }

    td {
        max-width: 200px;
        overflow: hidden;
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
