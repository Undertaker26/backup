@extends('layouts.layout')

<title>Live Stream</title>
<link rel="stylesheet" href="css/live.css">

@section('title', 'Index')

@section('content')
<style>

</style>
<div class="live-container">
    <h1 class="live-title">Live Streaming</h1>

    <div class="live-video">
        @if ($liveVideo)
            <iframe src="{{ $liveVideo->video_url }}" allowfullscreen></iframe>
        @else
            <p>No live video is currently available.</p>
        @endif
    </div>
</div>


@endsection
