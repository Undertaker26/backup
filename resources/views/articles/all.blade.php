@include('layouts.headgreen')

<title>All Articles | Scribe Entertainment</title>

    @section('content')

    <div class="container">
        <div class="articles">
            <div class="center-title">
                <h3>All Articles</h3>
            </div>
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-md-12 mb-4">
                    <div class="news-item">
                        <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/100x75' }}" alt="Article Image" class="news-image">
                        <div class="article-content ms-3">
                            <h3>{{ $article->title }}</h3>
                            <p>{{ Str::limit($article->content, 200) }}</p>
                            <span class="author">By {{ $article->user ? $article->user->username : 'Unknown' }} | </span>
                            <span class="time text-muted">{{ $article->created_at->diffForHumans() }}</span>
                            <div class="views-container">
                                <i class="fas fa-eye"></i>
                                <span class="views">{{ $article->views }} views</span>
                            </div>
                            <br>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <style>
 
        .center-title{
            margin-top:0;
        }

        .container {
            width: 100%; /* Full width */
            max-width: 935px;; /* No maximum width */
            margin: 0 auto; /* Center the container */
            padding: 0; /* Remove padding */
            align-items: center;
            background-color: transparent; /* No background color */
        }

        .articles {
            width: 100%; /* Full width */
            padding: 10px; /* Add some padding if needed */
        }

        .news-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: white; /* Background color for article items */
        }

        .news-item img {
            width: 150px; /* Set uniform width */
            height: 100px; /* Set uniform height */
            object-fit: cover; /* Ensures the image covers the area without distortion */
            margin-right: 15px;
            border-radius: 4px;
            flex-shrink: 0; /* Prevents the image from shrinking */
        }

        .article-content h3 {
            margin: 0;
            font-size: 16px; /* Adjusted font size for the title */
            font-weight: bold;
            color: black;
        }

        .article-content p {
            margin: 5px 0;
            color: #666;
            font-size: 13px;
        }

        .article-content .author {
            font-size: 12px;
            color: black;
        }

        .article-content .time {
            font-size: 12px;
            color: black;
        }

        .views-container {
            display: flex;
            align-items: center;
            margin-top: 5px;
            font-size: 12px;
            color: #666;
        }

        .views-container i {
            margin-right: 5px;
        }

        .btn-sm {
            font-size: 12px;
            padding: 5px 10px;
            color: white;
            background-color: blue;
            border-radius: 5px;
            text-decoration: none;
            align-items: center;
        }

        .btn-sm:hover {
            background-color: darkblue;
        }

        .center-title {
            text-align: center;
            margin-bottom: 30px;
            font-size:23px;
        }
    </style>
</head>

<body>
    </style>
</body>

</html>
