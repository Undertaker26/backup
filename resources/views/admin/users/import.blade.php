<!-- Modal -->
<div id="importUserModal" class="modal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <strong><h3 class="modal-title">Import Users</h3></strong>
            <button type="button" class="close" onclick="closeModal()">&times;</button>
        </div>
        <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="file">Select CSV file:</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
            </div>
            <div class="buttons">
                <button type="button" class="close-btn" onclick="closeModal()">Close</button>
                <button type="submit" class="import-btn">Import</button>
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
    max-width: 680px;
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

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.btn-primary, .import-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.import-btn:hover {
    background-color: #0056b3;
}

.close-btn {
    background-color: gray;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.close-btn:hover {
    background-color: #333;
}
</style>

<script>
    function openImportModal() {
        document.getElementById('importUserModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('importUserModal').style.display = 'none';
    }
</script>
