@extends('admin.dashboard')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('title', 'Manage Gallery')

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h2>Gallery Management</h2>
                </div>
                <div class="col text-right">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm" class="d-inline-block">
                        @csrf
                        <input type="file" name="file" id="fileInput" style="display: none;" required>
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('fileInput').click();">Upload</button>
                    </form>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>File Name</th>
                        <th>Uploaded On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                @if(strpos($item->file_path, '.mp4') !== false)
                                    <video class="img-preview" style="width: 80px; height: 80px;" muted>
                                        <source src="{{ Storage::url($item->file_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <img src="{{ Storage::url($item->file_path) }}" class="img-preview" style="width: 80px; height: 80px;">
                                @endif
                            </td>
                            <td>{{ basename($item->file_path) }}</td>
                            <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
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
        white-space: normal;
        word-wrap: break-word;
    }

    td {
        max-width: 200px;
        overflow: hidden;
        text-align: center;
    }

    .img-preview {
        object-fit: cover; /* Ensures images and videos cover the box without distortion */
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 0 2px rgba(0,0,0,0.2);
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

<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        document.getElementById('uploadForm').submit();
    });
</script>
@endsection
