<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    public function store(Post $post)
    {
        $share = new Share();
        $share->post_id = $post->id;
        $share->user_id = Auth::id();
        $share->save();

        return back();
    }
}