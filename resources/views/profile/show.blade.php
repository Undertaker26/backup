<link rel="stylesheet" href="css/post.css">

@section('content')
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }
    .profile-header {
        background-size: cover;
        background-position: center;
        text-align: center;
        position: relative;
    }
    .profile-header .profile-image-wrapper {
        position: relative;
        display: inline-block;
    }
    .profile-header img {
        width: 100px;
        height: 100px;
        margin-top:20px;
        object-fit: cover;
        margin-bottom:20px;
        border-radius: 50%;
        border: 4px solid white;
        cursor: pointer;
    }
    .profile-header .edit-icon {
        display: none;
        position: absolute;
        bottom: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        margin-bottom:10px;
        height: 30px;
        font-size: 20px;
        text-align: center;
        line-height: 30px;
        cursor: pointer;
    }
    .profile-header .profile-image-wrapper:hover .edit-icon {
        display: block;
    }
    .profile-header h1 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }
    .profile-header p {
        margin: 5px 0;
        color: #777;
    }
    .profile-header button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .profile-posts {
        padding: 20px;
        max-width: 800px;
        margin: auto;
    }
    .post {
        background-color: white;
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
 
    /* Hidden file input */
    .profile-header input[type="file"] {
        display: none;
    }
    .profconta {
    border: 1px solid #ddd;
    border-radius: 8px;
    display: center;
    margin: 20px auto;
    max-width: 800px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
</style>

<div class="profconta">
<div class="profile-header">
    <div class="profile-image-wrapper">
        <img src="{{ asset('storage/' . (auth()->user()->profile_image_url ?? 'default-profile.png')) }}" alt="Profile Picture" id="profileImage">
        <label for="profileImageUpload" class="edit-icon">✎</label>
        <input type="file" id="profileImageUpload" accept="image/*">
    </div>
    <strong><h1>{{ auth()->user()->username }}</h1></strong>
    <p>Student ID: {{ auth()->user()->student_id }}</p>    
    <p>Email: {{ auth()->user()->email }}</p>  
    <p><a href="{{ route('profile.edit') }}"  target="_blank" >Edit Profile</a></p>
    <br>
</div>
</div>

<div class="profile-posts">
    <!-- Add user posts here -->
    <div class="post">
        <p>First post content...</p>
    </div>
    <div class="post">
        <p>Second post content...</p>
    </div>
    <!-- Additional posts -->
</div>

<!-- Success/Error message -->

<script>
    document.getElementById('profileImage').addEventListener('click', function() {
        document.getElementById('profileImageUpload').click();
    });

    document.getElementById('profileImageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('profile_image', file);
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route('profile.uploadImage') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('profileImage').src = data.imageUrl;
                    showMessage('Profile image updated successfully!', 'success');
                } else {
                    showMessage('An error occurred while uploading the image.', 'error');
                }
            })
            .catch(error => {
                showMessage('An error occurred while uploading the image.', 'error');
            });
        }
    });

</script>

