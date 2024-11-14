@extends('layouts.nav')

@section('content')
<div class="container">
    <h1>Events</h1>
    
    @if($events->isEmpty())
        <p>No events available.</p>
    @else
        <div class="list-group">
            @foreach($events as $event)
                <div class="list-group-item">
                    <h5>{{ $event->title }}</h5>
                    <p><strong>Date:</strong> {{ $event->date->format('F j, Y') }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p>{{ $event->description }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
