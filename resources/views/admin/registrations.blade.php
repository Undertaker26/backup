@extends('admin.dashboard')

@section('title', 'Organization Chart')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="col-md-9 offset-md-3 main-content">
    <div class="card mt-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col">
                    <h1>Pending Registrations</h1>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($users->isEmpty())
                        <p>No pending registrations.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Username</th>
                                    <th>Course</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->student_id }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->course }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>
                                            <!-- Approve Form -->
                                            <form action="{{ route('admin.approve', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to approve this user?');">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>

                                            <!-- Reject Button -->
                                            <button type="button" class="btn btn-danger btn-sm" onclick="openModal('{{ route('admin.reject', $user) }}')">Reject</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Reason Modal -->
<div id="rejectUserModal" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <strong><h3 class="modal-title">Reject User</h3></strong>
            <button type="button" class="close" onclick="closeModal()">&times;</button>
        </div>
        <form id="rejectUserForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="rejection_reason">Reason for Rejection:</label>
                    <textarea id="rejection_reason" name="rejection_reason" class="form-control" required></textarea>
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="close-btn" onclick="closeModal()">Close</button>
                <button type="submit" class="ban-btn" onclick="return confirm('Are you sure you want to reject this user?');">Reject User</button>
            </div>
        </form>
    </div>
</div>

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
    .btn-danger, .btn-success {
        padding: 5px 10px;
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 5px;
        max-width: 500px;
        width: 100%;
    }
    .modal-header, .modal-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header .close {
        font-size: 24px;
        background: none;
        border: none;
        cursor: pointer;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    .buttons {
        display: flex;
        justify-content: space-between;
    }
    .ban-btn, .close-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }
    .ban-btn {
        background-color: #dc3545;
        color: white;
    }
    .close-btn {
        background-color: gray;
        color: white;
    }
    .ban-btn:hover {
        background-color: #c82333;
    }
    .close-btn:hover {
        background-color: #555;
    }
</style>

<script>
    function openModal(actionUrl) {
        document.getElementById('rejectUserForm').action = actionUrl;
        document.getElementById('rejectUserModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('rejectUserModal').style.display = 'none';
    }
</script>
@endsection
