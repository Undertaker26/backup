@extends('layouts.nav')
@include('layouts.header')

@section('content')

<body>
      

<nav class="navbar">
    <ul class="navbar-menu">
        <li><a href="{{ route('posts.index') }}" class="{{ Request::routeIs('posts.index') ? 'active' : '' }}">Posts</a></li>
        <li><a href="{{ route('articles') }}" class="{{ Request::routeIs('articles') ? 'active' : '' }}">News</a></li>
        <li><a href="{{ route('cartoonist') }}" class="{{ Request::routeIs('cartoonist') ? 'active' : '' }}">Cartoonist</a></li>
        <li><a href="{{ route('opinion') }}" class="{{ Request::routeIs('opinion') ? 'active' : '' }}">Opinion</a></li>
        <li><a href="{{ route('events') }}" class="{{ Request::routeIs('events') ? 'active' : '' }}">Events</a></li>
        <li><a href="{{ route('gallery.show') }}" class="{{ Request::routeIs('gallery.show') ? 'active' : '' }}">Gallery</a></li>
        <li><a href="{{ route('live.show') }}" class="{{ Request::routeIs('live.show') ? 'active' : '' }}">Live</a></li>
        <li><a href="{{ route('organation') }}" class="{{ Request::routeIs('organation') ? 'active' : '' }}">Chart</a></li>
        <li><a href="{{ route('about') }}" class="{{ Request::routeIs('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ route('profile.show') }}" class="{{ Request::routeIs('profile.show') ? 'active' : '' }}"> {{ auth()->user()->username }}</a></li>
        <li><a href="{{ route('logout') }}" class="{{ Request::routeIs('logout') ? 'active' : '' }}">Logout</a></li>
    </ul>
</nav>



</body>

</html>
