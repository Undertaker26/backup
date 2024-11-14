<?php

namespace App\Http\Controllers\SubAdmin;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Models\ViewedArticle;
use App\Models\Users;
use Illuminate\Http\Request;

class ArticlessController extends Controller
{
    // Display all articles
    // public function index()
    // {
        // $articles = Article::all();
            // $articles = Article::where('usertype', '!=', 'admin')->get();
            public function index()
            {
                // Subadmin sees only their own articles
                $articles = Article::where('user_id', auth()->user()->id)->get();
                return view('subadmin.article.index', compact('articles'));
            
        return view('subadmin.article.index', compact('articles'));
    }

    // Show form to create a new article
    public function create()
    {
        return view('subadmin.article.create');
    }

    // Store a newly created article
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_location' => 'required|in:main,sidebar,latest',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'display_location' => $request->display_location,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('subadmin.article.index')->with('success', 'Article created successfully.');
    }

    // Show a single article with details
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
        }
    
        return view('articles.show', compact('article'));
    

        // Fetch the latest posts (you can adjust the query to suit your needs)
        $latestPosts = Article::orderBy('created_at', 'desc')->take(5)->get();

        return view('articles.show', compact('article', 'latestPosts'));
    }

    // Show form to edit an existing article
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('subadmin.article.edit', compact('article'));
    }

    // Update an existing article
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_location' => 'required|in:main,sidebar,latest',
        ]);

        $article = Article::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($article->image) {
                \Storage::delete('public/' . $article->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $article->image = $imagePath;
        }

        $article->title = $request->title;
        $article->content = $request->content;
        $article->display_location = $request->display_location;
        $article->user_id = auth()->id(); 
        $article->save();

        return redirect()->route('subadmin.article.index')->with('success', 'Article updated successfully.');
    }

    // Delete an existing article
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Delete the image if exists
        if ($article->image) {
            \Storage::delete('public/' . $article->image);
        }

        $article->delete();

        return redirect()->route('subadmin.article.index')->with('success', 'Article deleted successfully.');
    }
}
