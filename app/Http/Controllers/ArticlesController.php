<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\ViewedArticle;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    // Display all articles
    // app/Http/Controllers/ArticleController.php

public function showAll()
{
    $articles = Article::all();
    return view('articles.all', compact('articles'));
}
public function show($id)
{
    $article = Article::findOrFail($id);

    // Check if the user is authenticated
    if (auth()->check()) {
        $user = auth()->user();
        
        // Check if the user has already viewed this article
        $viewed = ViewedArticle::where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->exists();

        if (!$viewed) {
            // Increment the views count
            $article->increment('views');
            // Record the view
            ViewedArticle::create([
                'user_id' => $user->id,
                'article_id' => $article->id,
            ]);
        }
    
    return view('articles.show', compact('article'));
}
    // Fetch the latest posts (you can adjust the query to suit your needs)
    $latestPosts = Article::orderBy('created_at', 'desc')->take(5)->get();

    return view('articles.show', compact('article', 'latestPosts'));
}

public function showByTag($tag)
{
    $articles = Article::where('tag', $tag)->latest()->get();
    return view('articles.byTag', compact('articles', 'tag'));
}

    public function index()
    {
        $articles = Article::all();
        return view('articles.index', compact('articles'));
    }

    // Constructor to restrict access
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated for all routes
    }

}
