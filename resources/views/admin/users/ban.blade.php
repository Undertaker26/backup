<!-- resources/views/admin/ban_user_modal.blade.php -->

<!-- Modal -->
<div id="banUserModal" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
        <strong> <h3 class="modal-title">Ban User</h3></strong>
            <button type="button" class="close" onclick="closeModal()">&times;</button>
        </div>
        <form id="banUserForm" action="" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="ban_reason">Reason for Ban:</label>
                    <textarea id="ban_reason" name="ban_reason" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="ban_duration">Ban Duration (days):</label>
                    <input type="number" id="ban_duration" name="ban_duration" class="form-control" required min="1">
                </div>
            </div>
            <div class="buttons">
            <button type="button" class="close-btn" onclick="closeModal()">Close</button>
                <button type="submit" class="ban-btn">Ban User</button>
            </div>
        </form>
    </div>
</div>


<style>
/* Unified Modal Styles */
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
    max-width:680px;
    max-height: 90%;
    overflow-y: auto;
}

.modal-header, .modal-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header .close {
    font-size: 24px;
    border: none;
    background: none;
    cursor: pointer;
}

.form-group, .input-container {
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

.form-control, .form-controls {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}


.form-control:focus, .form-controls:focus {
    border-color: #007bff;
    outline: none;
}

.text-danger {
    color: #dc3545;
    font-size: 12px;
}

.btn-secondary, .btn-danger, .btn-primary {
    padding: 8px 16px;
    border: none;
    
    border-radius: 4px;
    cursor: pointer;
}
.buttons {
    display: flex;
    align-items: center;  
    justify-content:space-between;
    margin-right:20px auto;
}

.ban-btn {
    background-color: #dc3545; /* Red background color */
    color: white; /* White text color */
    padding: 10px 20px; /* Padding inside the button */
    border: none; /* Remove default border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Change cursor to pointer on hover */
    font-size: 14px; /* Font size of the button text */
    transition: background-color 0.3s ease; /* Smooth transition for background color */

}

.ban-btn:hover {
    background-color: #c82333; /* Darker red on hover */
}
.close-btn {
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


.btn-dangers {
    background-color: black;
    color: white;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.close {
    color: red;
}
</style>

<script>
    function openModal(actionUrl) {
        document.getElementById('banUserForm').action = actionUrl;
        document.getElementById('banUserModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('banUserModal').style.display = 'none';
    }
</script>
