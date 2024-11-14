@extends('layouts.layout')

@section('title', 'Events')
<title>Events | Scribe Entertainment</title>
<link rel="stylesheet" href="css/events.css">

@section('content')
<div class="main-container">
    @if($events->isEmpty())
        <div class="no-events">
            <center><p>No events available</p>
        </div>
    @else
        @foreach ($events as $event)
        <div class="event">
            <div class="event-header">
                <h2>{{ $event->title }}</h2>
                <button onclick="toggleDetails(this)">Show Details</button>
            </div>
            <div class="event-details" style="display: none;">
                <p><strong>Date:</strong> {{ $event->date->format('F j, Y') }}</p>
                <p><strong>Time:</strong> {{ $event->start_time->format('g:i A') }} - {{ $event->end_time->format('g:i A') }}</p>
                <p><strong>Location:</strong> {{ $event->location }}</p>
                <p><strong>Description:</strong> {{ $event->description }}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>

<script>
    function toggleDetails(button) {
        const details = button.parentElement.nextElementSibling;
        if (details.style.display === "none" || details.style.display === "") {
            details.style.display = "block";
            button.textContent = "Hide Details";
        } else {
            details.style.display = "none";
            button.textContent = "Show Details";
        }
    }
</script>
@endsection
