<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Other methods ...


    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->update($data);

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
            $post->save();
        }

        // Log the update activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'Post',
            'description' => 'Updated post.',
        ]);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Log the delete activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'Post',
            'description' => 'Deleted post.',
        ]);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id; // Automatically set user_id from logged-in user
        $post->username = Auth::user()->username; // Automatically set username from logged-in user
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        // Log the create activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'Post',
            'description' => 'Post created successfully.',
        ]);
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
}
