<!-- @extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image">
    <p>{{ $article->content }}</p>
</div>
@endsection -->
