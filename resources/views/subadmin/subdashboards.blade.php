@extends('subadmin.subdashboard')

@section('content')

<div class="col-md-9 offset-md-3 main-content">
            <div class="user-profile">
                <span class="username">{{ Auth::user()->username }}</span>
                <span class="arrow">&#9662;</span> <!-- Downward arrow character -->
                <div class="dropdown-menu">
                <a href="{{ route('subadmin.profile.edit') }}">Profile</a>
                <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
<style>
.user-profile {
    display: flex;
    margin-left:750px;
    align-items: center;
    position: relative;
    font-size: 16px; /* Smaller font size for profile */
}

.username {
    margin-right: 8px; /* Reduced margin */
}

.arrow {
    font-size: 16px; /* Smaller arrow */
    cursor: pointer;
}

.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 1px 5px rgba(0,0,0,0.2);
    z-index: 1000;
    font-size: 14px; /* Smaller font size for menu items */
}

.dropdown-menu a {
    display: block;
    font-size:17px;
    padding: 8px 12px; /* Reduced padding */
    color: #333;
    text-decoration: none;
}

.dropdown-menu a:hover {
    background-color: #f8f9fa;
}

.user-profile:hover .dropdown-menu {
    display: block;
}

.main-content {
    margin-left: 290px;
    margin-top: 20px;
}

.card {
    margin-top: 20px;
    border-radius: 0.5rem;
}

.card-title {
    font-size: 1.25rem;
}

.card-text {
    font-size: 1.5rem;
    font-weight: bold;
}

</style>
   

    <!-- Metrics Boxes -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <p class="card-text">{{ $totalPosts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <p class="card-text">{{ $totalArticles }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .main-content {
        margin-left: 290px;
        margin-top: 20px; /* Adjust this value based on navbar height */
    }

    .card {
        margin-top: 20px;
        border-radius: 0.5rem;
    }
    .user-profile {
        display:flex;
        justify-content: end;
    }
span{
    font-size:20px;
}
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
    }

    .card-text {
        font-size: 2rem;
    }

    .display-4 {
        font-size: 2.5rem;
    }

    .font-weight-bold {
        font-weight: 700;
    }

    canvas {
        max-width: 100%;
        height: auto;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

@endsection
