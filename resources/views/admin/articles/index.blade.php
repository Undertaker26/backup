@extends('admin.dashboard')
<title>Articles Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">



@section('title', 'Manage Articles')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h2>All Articles</h2>
                </div>
                <div class="col text-right">
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Insert New Article</a>
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
                        <!-- <th>Content</th> -->
                        <th>Display Location</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <!-- <td class="text-wrap">{{ Str::limit($article->content, 50) }}</td> -->
                            <td>{{ ucfirst($article->display_location) }}</td>
                            <td>{{ $article->created_at->format('m-d-Y') }}</td>
                            <td>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
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
        padding: 5px;
        font-size: 12px;
        margin-right: 5px;
    }
    .btn-warning, .btn-danger, .btn-success {
        padding: 5px 10px;
    }
</style>
@endsection
