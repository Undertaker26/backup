<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'keywords' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'content' => 'required|string',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->category = $request->category;
        $post->keywords = $request->keywords;
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $post->image = $path;
        }

        $post->save();

        return redirect()->route('admin.posts.create')->with('success', 'Post created successfully.');
    }
}
