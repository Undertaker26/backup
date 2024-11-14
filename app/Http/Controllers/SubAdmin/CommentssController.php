<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentssController extends Controller
{
    public function index()
    {
        $comments = Comment::all(); // Adjust as needed to paginate or filter comments
        return view('subadmin.comments.index', compact('comments'));
    }
    public function destroy(Comment $comments)
    {
        $comments->delete();

        return redirect()->route('subadmin.comments.index')->with('success', 'Comments deleted successfully.');
    }
}



