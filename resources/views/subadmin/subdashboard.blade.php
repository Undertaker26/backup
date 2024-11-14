@extends('layouts.admin')
<title>Subadmin Dashboard  | Scribe Entertainment</title>

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 sidebar">
        <a href="{{ url('subadmin/subdashboards') }}">
            <h2>Sub Admin</h2>
            <!-- <a href="{{ route('subadmin.subdashboards') }}">Dashboard</a> -->

            <a href="{{ route('subadmin.article.index') }}">Insert New Article</a>
            <a href="{{ route('subadmin.managepost.index') }}">Insert New Posts</a>
            <a href="{{ route('subadmin.userdata.index') }}">Student Records</a>
            <a href="{{ route('subadmin.comments.index') }}">View all Comments</a>
            <a href="{{ route('subadmin.event.index') }}">Event Management</a>
            <!-- <a href="{{ route('logout') }}">Admin Logout</a> -->
        </div>


</div>

</body>
</html>
