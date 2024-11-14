<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all(); // Adjust as needed to paginate or filter comments
        return view('admin.comments.index', compact('comments'));
    }
    public function destroy(Comment $comments)
    {
        $comments->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Comments deleted successfully.');
    }
}



