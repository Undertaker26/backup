@extends('layouts.layout')

<title>News | Scribe Entertainment</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="css/article.css">
@section('content')

    <div class="article-container">
        <div class="main-article-content">
            @foreach ($articles as $article)
                @if ($article->display_location === 'main')
                    <div class="main-article" onclick="window.location='{{ route('articles.show', $article->id) }}'">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Main Article Image"  class="uniform-image">
                        @endif
                        <h1>{{ $article->title }}</h1>
                        <p>{{ Str::limit($article->content, 100) }}</p>
                        @if($article->user)
                            <span>Published by: {{ $article->user->username }}</span>
                        @endif
                        <span class="time">{{ $article->created_at->diffForHumans() }}</span>
                    </div>
                    @break
                @endif
            @endforeach

            <div class="article-sidebar">
                @foreach ($articles as $article)
                    @if ($article->display_location === 'sidebar')
                        <div class="sidebar-article" onclick="window.location='{{ route('articles.show', $article->id) }}'">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Sidebar Article ">
                            @endif
                            <h3>{{ $article->title }}</h3>
                            @if($article->user)
                                <span>Published by: {{ $article->user->username }}</span>
                            @endif
                            <span class="time">{{ $article->created_at->diffForHumans() }}</span>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="latest-article">
            <h2 class="display-4 mb-4">Latest News</h2>
            <div class="row">
                @foreach ($articles->sortByDesc('created_at')->take(5) as $article)
                    <div class="col-md-6 mb-4">
                        <div class="news-item d-flex">
                            <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/100x75' }}" alt="Article Image" class="news-image">
                            <div class="article-content ms-3">
                                <h3>{{ $article->title }}</h3>
                                <p>{{ Str::limit($article->content, 100) }}</p>
                                <span class="author">Published By {{ $article->user ? $article->user->username : 'Unknown' }} | </span>
                                <span class="time text-muted">{{ $article->created_at->diffForHumans() }}</span>
                                <div class="views-container">
                                    <i class="fas fa-eye"></i>
                                    <span class="views">{{ $article->views }} Views</span>
                                </div>
                                <br>
                                <a href="{{ route('articles.show', $article->id) }}" target="_blank" class="btn btn-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="additional-articles">
                <div class="row">
                    @foreach ($articles->sortByDesc('created_at')->skip(4) as $article)
                        <div class="col-md-6 mb-4">
                            <div class="news-item d-flex">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/100x75' }}" alt="Article Image" class="news-image">
                                <div class="article-content ms-3">
                                    <h3>{{ $article->title }}</h3>
                                    <p>{{ Str::limit($article->content, 100) }}</p>
                                    <p class="time text-muted">{{ $article->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('articles.show', $article->id) }}" target="_blank" class="btn btn-primary btn-sm">Read More &gt;&gt;</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <center>
            <div>
                <a href="{{ route('articles.all', $article->id) }}" target="_blank" class="btn btn-primary btn-sm">Show All Articles</a>
            </div>
        </center>
    </div>
@endsection
