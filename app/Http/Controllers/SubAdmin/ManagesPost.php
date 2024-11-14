<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagesPost extends Controller
{
    public function __construct()
    {
        $this->middleware('subadmin');
    }
    

    public function index()
    {
        $posts = Post::all();
        return view('subadmin.managepost.index', compact('posts'));
    }

    public function create()
    {
        return view('subadmin.managepost.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $request->validate([
        //     'content' => 'required|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $post = new Post();
        $post->user_id = Auth::user()->id; // Automatically set student_id from logged-in user
        $post->username = Auth::user()->username;     // Automatically set name from logged-in user
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $post->image = $imageName;
        }

        $post->save();
        return redirect()->route('subadmin.managepost.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('subadmin.managepost.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $postData = [
            'content' => $request->input('content'),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $postData['image'] = $imagePath;
        }

        $post->update($postData);

        return redirect()->route('subadmin.managepost.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('subadmin.managepost.index')->with('success', 'Post deleted successfully.');
    }
}
