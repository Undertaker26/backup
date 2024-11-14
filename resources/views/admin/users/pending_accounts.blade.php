<style>
    /* Modal Container */
.modal-container {
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

/* Modal Box */
.modal-box {
    background-color: white;
    border-radius: 8px;
    width: 80%;
    max-width: 900px;
    padding: 20px;
    margin-left:215px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Modal Header */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.modal-title {
    margin: 0;
    font-size: 1.5em;
}

/* Close Button */
.close-button {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
    color: red;
}

/* Table Styling */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 14px;
}

.table th, .table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

/* Button Styling */
.btn {
    border: none;
    border-radius: 4px;
    cursor: pointer;
    padding: 5px 10px;
    font-size: 12px;
    margin-right: 5px;
    transition: background-color 0.3s;
}

.btn-success {
    background-color: #28a745;
    color: white;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-close {
    background-color: gray; /* Red background color */
    color: white; /* White text color */
    padding: 10px 20px; /* Padding inside the button */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Change cursor to pointer on hover */
    font-size: 14px; /* Font size of the button text */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

.close-btn:hover {
    background-color: white; /* Darker red on hover */

}

.btn:hover {
    opacity: 0.8;
}

/* Hidden Input Field */
.hidden-input {
    display: none;
}

/* Error Styling */
.error-message {
    color: red;
    font-size: 12px;
}

</style>
<!-- Pending Registrations Modal -->
<!-- Pending Registrations Modal -->
<div id="pendingRegistrationsModal" class="modal-container" style="display:none;">
    <div class="modal-box">
        <div class="modal-header">
            <strong><h1 class="modal-title">Pending Registrations</h1></strong>
            <button type="button" class="close-button" onclick="closePendingModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($users->isEmpty())
                <p class="no-records">No pending registrations.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Username</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $user)
                            <tr>
                                <td>{{ $user->student_id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->course }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <form action="{{ route('admin.approve', $user) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="toggleRejectReason({{ $user->id }})">Reject</button>
                                    <form id="reject-form-{{ $user->id }}" action="{{ route('admin.reject', $user) }}" method="POST" style="display:none;">
                                        @csrf
                                        <input type="text" name="rejection_reason" placeholder="Reason" required>
                                        <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-close" onclick="closePendingModal()">Close</button>
        </div>
    </div>
</div>

<script>
function toggleRejectReason(userId) {
    var form = document.getElementById('reject-form-' + userId);
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}

function closePendingModal() {
    document.getElementById('pendingRegistrationsModal').style.display = 'none';
}
</script>
