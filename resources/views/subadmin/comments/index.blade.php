@extends('subadmin.subdashboard')
<title>View Comments  | Scribe Entertainment</title>

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
                            <form action="{{ route('subadmin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
        margin-right: 5px;
    }
</style>
@endsection
