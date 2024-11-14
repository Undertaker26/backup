<?php

    namespace App\Http\Controllers\SubAdmin;

    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use App\Models\Article;
    use App\Models\User;
    
    class AnalyticssController extends Controller
    {
        public function index()
        {
            $totalPosts = Post::count();
            $totalArticles = Article::count();
            // $totalUsers = User::count();
            // $totalUsers = User::where('usertype', '!=', 'subadmin', false)->count(); // Exclude admin users
            $totalUsers = User::whereNotIn('usertype', ['admin', 'subadmin'], false)->count(); // Exclude admin and sub



    
            return view('subadmin.subdashboards', compact('totalPosts', 'totalArticles', 'totalUsers'));
        }
    }
    