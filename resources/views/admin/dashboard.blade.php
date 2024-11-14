@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 sidebar">
        <a href="{{ url('admin/dashboards') }}">
            <h2>Admin Panel</h2>
            <!-- <a href="{{ route('admin.dashboards') }}">Dashboard</a> -->
            <a href="{{ route('admin.comments.index') }}">View all Comments</a>
            <a href="{{ route('admin.userdata.index') }}">Student Records</a>
            <a href="{{ route('admin.articles.index') }}">Article Management</a>
            <a href="{{ route('admin.managepost.index') }}">Post Management</a>
            <a href="{{ route('admin.users.index') }}">User Management</a>
            <a href="{{ route('admin.events.index') }}">Event Management</a>
            <a href="{{ route('admin.gallery.index') }}">Gallery Management</a>
            <a href="{{ route('admin.live.create') }}">Live Management</a>
            <a href="{{ route('admin.organ_chart.index') }}">Organizational Chart</a>
            <!-- <a href="{{route('logout')}}">Logout</a> -->
            <!-- <a href="{{ route('logout') }}">Admin Logout</a> -->
        </div>


</div>

</body>
</html>
