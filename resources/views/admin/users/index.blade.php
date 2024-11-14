@extends('admin.dashboard')
<title>User Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')
<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h2>Manage Users</h2>
                </div>
                <div class="col text-right">
                    <a href="{{ route('admin.registrations') }}" target="_blank" class="btn btn-primary">Pending Accounts
                        @if($pendingCount > 0)
                            <span class="badge badge-light ml-2">{{ $pendingCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
                    <a href="{{ route('admin.users.backup') }}" class="btn btn-secondary">Backup Data</a>
<!-- Include the import user modal view -->

<!-- Button to trigger the import modal -->
<button type="button" class="btn btn-info" onclick="openImportModal()">Import Users</button>

                </div>
            </div>

            <!-- Search Form -->
            <div class="row mb-4 justify-content-center">
                <div class="col-md-6">
                    <form id="search-form" action="{{ route('admin.users.index') }}" method="GET" class="position-relative">
                        <div class="input-group">
                            <input type="text" name="search" id="search-input" class="form-control" placeholder="Enter Username or Student ID" value="{{ request()->query('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                        <div id="suggestions" class="position-absolute bg-white border" style="display: none; z-index: 1000; width: 100%;"></div>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($users->isEmpty())
                <div class="alert alert-info">
                    No results found.
                </div>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Username</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->student_id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->course }}</td>
                                <td>
                                    @switch($user->status)
                                        @case('current_student')
                                            Student
                                            @break
                                        @case('alumni')
                                            Alumni
                                            @break
                                        @default
                                            Unknown Status
                                    @endswitch
                                </td>

                                <!-- <td>
                                    @if($user->banned_until)
                                        Banned until {{ $user->banned_until->format('m-d-Y') }}
                                    @else
                                        Active
                                    @endif
                                </td> -->
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('m-d-Y') }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    <!-- Ban/Unban Button -->
                                    @if($user->banned_until)
                                        <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Unban">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <button type="button" class="btn btn-sm btn-danger" onclick="openModal('{{ route('admin.users.ban', $user->id) }}')" title="Ban">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@include('admin.users.import')

@include('admin.users.ban')

<style>
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
    .badge {
        background-color: red;
        color: white;
    }
    .input-group {
        margin-top: 20px;
        position: relative;
    }
    #suggestions {
        max-height: 200px;
        overflow-y: auto;
    }
    .suggestion-item {
        padding: 10px;
        cursor: pointer;
    }
    .suggestion-item:hover {
        background-color: #f8f9fa;
    }
</style>

<script>
    $(document).ready(function () {
        const searchInput = $('#search-input');
        const suggestionsContainer = $('#suggestions');
        const searchForm = $('#search-form');

        searchInput.on('input', function () {
            const query = $(this).val().trim();

            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('admin.users.search_suggestions') }}",
                    type: 'GET',
                    data: { query: query },
                    success: function (data) {
                        suggestionsContainer.empty().show();

                        if (data.length > 0) {
                            data.forEach(user => {
                                const displayText = user.username ? `${user.username} (${user.student_id})` : user.student_id;
                                suggestionsContainer.append(`<div class="suggestion-item" data-id="${user.id}" data-username="${user.username}" data-student-id="${user.student_id}">
                                    ${displayText}
                                </div>`);
                            });
                        } else {
                            suggestionsContainer.append('<div class="suggestion-item">No results found</div>');
                        }
                    }
                });
            } else {
                suggestionsContainer.empty().hide();
                searchForm.submit(); // Submit form to show all data if search input is cleared
            }
        });

        $(document).on('click', '.suggestion-item', function () {
            const username = $(this).data('username');
            const studentId = $(this).data('student-id');

            if (username) {
                searchInput.val(username);
            } else {
                searchInput.val(studentId);
            }
            searchForm.submit(); // Submit form with selected suggestion
        });
    });

    function openModal(actionUrl) {
        document.getElementById('banUserForm').action = actionUrl;
        document.getElementById('banUserModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('banUserModal').style.display = 'none';
    }
</script>
@endsection
