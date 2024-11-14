@include('layouts.headgreen')
<link rel="icon" href="logo2.png"  type="image/x-icon"/>

@section('title', $article->title)

@section('content')
<div class="article-container" style="max-width: 800px; margin: 0 auto; padding: 20px;">

    <div class="back-icon" style="margin-bottom: 20px;">
        <a href="{{ url()->previous() }}" style="text-decoration: none; color: black;">
            <img src="https://cdn-icons-png.flaticon.com/512/93/93634.png" alt="Back" style="width: 24px; vertical-align: middle; margin-right: 5px;">
            <span>Back</span>
        </a>
    </div>
    

    <div class="article-header">
        <h1 class="article-title" style="margin-bottom: 10px;">{{ $article->title }}</h1>
        <div class="article-meta" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div>
            <span class="author">By {{ $article->user ? $article->user->username : 'Unknown' }} |</span>
            <span class="article-date">{{ $article->created_at->format('F j, Y | g:i a') }}</span>
            </div>

            <div class="social-share">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" style="margin-right: 10px;">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Share on Facebook" style="width: 24px;">
                </a>
                <a href="fb-messenger://share/?link={{ url()->current() }}" target="_blank">
                <img src="{{ asset('messenger.png') }}" alt="Share on Messenger" style="width: 24px;">
                </a>
            </div>
        </div>
    </div>

    <img src="{{ asset('storage/' . $article->image) }}" alt="Article Image" class="article-image" style="width: 100%; max-width: 800px; margin-bottom: 20px;">

    <p class="article-content" style="word-wrap: break-word; white-space: pre-line; line-height: 1.6; margin-bottom: 20px;">{{ $article->content }}</p>
   

    <div class="comments-section" style="margin-top: 40px;">
        <h2 style="margin-bottom: 20px;">Comments</h2>
            @csrf
            <textarea name="comment" rows="4" placeholder="Write your comment here..." style="width: 100%; margin-bottom: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Post Comment</button>
        </form>
        <ul style="list-style: none; padding: 0; margin-top: 20px;">
                <li style="border-bottom: 1px solid #ddd; padding: 10px 0;">
                </li>
            
        </ul>
    </div>
</div>
@include('layouts.footer')
</body>
</html>
