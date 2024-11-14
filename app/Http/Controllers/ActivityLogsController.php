<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogsController extends Controller
{
    public function index(Request $request)
    {
        // Get the activity type from request, default to 'login'
        $type = $request->input('type', 'login');

        // Fetch recent activity logs for the authenticated user based on the activity type
        $recentLogs = ActivityLog::with('user')
            ->where('user_id', Auth::id())
            ->where('activity_type', $type)
            ->latest()
            ->take(5)
            ->get();

        // Fetch all activity logs for the authenticated user with pagination based on the activity type
        $logs = ActivityLog::with('user')
            ->where('user_id', Auth::id())
            ->where('activity_type', $type)
            ->paginate(10);

        return view('activitylogs.index', [
            'recentLogs' => $recentLogs,
            'logs' => $logs,
            'type' => $type
        ]);
    }

    public function clearAllActivityLogs()
    {
        // Delete all activity logs for the authenticated user
        ActivityLog::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', 'Your activity logs have been cleared.');
    }
}
