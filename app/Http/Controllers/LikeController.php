<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // LikeController.php
public function toggleLike(Post $post)
{
    $user = auth()->user();
    $like = $post->likes()->where('user_id', $user->id)->first();

    if ($like) {
        $like->delete(); // Unlike
    } else {
        $post->likes()->create(['user_id' => $user->id]); // Like
    }

    return redirect()->back();
}

    public function store(Post $post)
    {
        $like = new Like();
        $like->post_id = $post->id;
        $like->user_id = Auth::id();
        $like->save();

        return back();
    }
}