@extends('subadmin.subdashboard')
@section('title', 'Manage Articles | Scribe Entertainment')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h2>All Articles</h2>
                </div>
                <div class="col text-right">
                    <a href="{{ route('subadmin.article.create') }}" class="btn btn-primary">Insert New Article</a>
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
                        <th>Title</th>
                        <th>Content</th>
                        <th>Display Location</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td class="text-wrap">{{ Str::limit($article->content, 50) }}</td>
                            <td>{{ ucfirst($article->display_location) }}</td>
                            <td>{{ $article->created_at->format('m-d-Y') }}</td>
                            <td>
                                <a href="{{ route('subadmin.article.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('subadmin.article.destroy', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No articles found.</td>
                        </tr>
                    @endforelse
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
    
    .success-message,
    .error-message,
    .password-mismatch {
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
        font-size: 16px;
        display: none;
    }
    
    .success-message {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        animation: fadeInOut 3s ease-out;
    }
    
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .main-content {
        margin-left: 290px;
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
</style>
@endsection
