<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use App\Models\Article;
    use App\Models\ActivityLog;
    use App\Models\User;
    use Illuminate\Http\Request;

    
    class AnalyticsController extends Controller
    {
        public function index()
        {
            $totalPosts = Post::count();
            $totalArticles = Article::count();
            // $totalUsers = User::count();
            // $totalUsers = User::where('usertype', '!=', 'admin', false)->count(); // Exclude admin users
            $totalUsers = User::whereNotIn('usertype', ['admin', 'subadmin'])
            ->where('account_status', 'approved')
            ->count();


            
                // Fetch recent activity logs (e.g., last 5 logs)
                $recentLogs = ActivityLog::with('user')->latest()->take(5)->get();
        
                // Fetch all activity logs with pagination
                $logs = ActivityLog::with('user')->paginate(10);
        
          
        
                return view('admin.dashboards', compact('recentLogs', 'logs', 'totalPosts', 'totalArticles', 'totalUsers'));
            }
            public function fetchRecentActivities()
            {
                $recentLogs = ActivityLog::latest()->take(5)->get(); // Adjust as needed
            
                return response()->json(view('admin.partials.activity_logs', compact('recentLogs'))->render());
            }
            
    }