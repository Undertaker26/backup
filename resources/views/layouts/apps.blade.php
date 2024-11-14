@extends('layouts.app')

@section('content')
<div class="header">
        <a href="{{ url('articles') }}">
            <img src="logo.png" alt="Scribe Logo" class="logo">
            <!-- <span>Scribe Entertainment</span> -->
        </a>
    </div>
        <div class="navbar">
    <a href="{{ route('posts.index') }}" class="{{ Request::routeIs('posts.index') ? 'active' : '' }}">Posts</a>
        <!-- <a href="{{ route('post') }}" class="<?php echo (Request::is('post') ? 'active' : ''); ?>">Posts</a> -->
        <a href="{{ route('articles') }}" class="{{ Request::routeIs('articles') ? 'active' : '' }}">News</a>
        <a href="{{ route('sport') }}" class="<?php echo (Request::is('sport') ? 'active' : ''); ?>">Sports</a>
        <a href="{{ route('scitech') }}" class="<?php echo (Request::is('scitech') ? 'active' : ''); ?>">Sci-Tech</a>
        <a href="{{ route('cartoonist') }}" class="<?php echo (Request::is('cartoonist') ? 'active' : ''); ?>">Cartoonist</a>
        <a href="{{ route('opinion') }}" class="<?php echo (Request::is('opinion') ? 'active' : ''); ?>">Opinion</a>
        <a href="{{ route('events') }}" class="{{ Request::routeIs('events') ? 'active' : '' }}">Events</a>
        <!-- <a href="{{ route('video') }}" class="<?php echo (Request::is('video') ? 'active' : ''); ?>">Videos</a> -->
        <!-- <a href="{{ route('album') }}" class="<?php echo (Request::is('album') ? 'active' : ''); ?>">Album</a> -->
        <a href="{{ route('gallery.show') }}" class="{{ Request::routeIs('gallery.show') ? 'active' : '' }}">Gallery</a>
        <a href="{{ route('live.show') }}" class="{{ Request::routeIs('live.show') ? 'active' : '' }}">Live</a>
        <a href="{{ route('organation') }}" class="{{ Request::routeIs('organation') ? 'active' : '' }}">Chart</a>
        <a href="{{ route('about') }}" class="<?php echo (Request::is('about') ? 'active' : ''); ?>">About</a>
        <!-- <a href="{{ route('profile.edit') }}" class="<?php echo (Request::is('profile.edit') ? 'active' : ''); ?>">Profile</a>
        <a href="{{ route('logout') }}" class="<?php echo (Request::is('logout') ? 'active' : ''); ?>">Logout</a> -->
        <div class="user-profile">
            <span>{{ Auth::user()->username }}</span>
            <span class="arrow">&#9662;</span>
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}">Edit Profile</a>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
  @endsection