<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    
    public function index()
{
    // Fetch recent activity logs (e.g., last 5 logs)
    $recentLogs = ActivityLog::with('user')->latest()->get();

    // Fetch all activity logs with pagination
    $logs = ActivityLog::with('user')->paginate(10);



    return view('admin.activityrecords.index', compact('recentLogs', 'logs'));
}
public function clearAllActivityLogs()
{
    // Delete all activity logs
    ActivityLog::truncate();

    return redirect()->back()->with('success', 'All activity logs have been cleared.');
}

public function fetchRecentActivities()
{
    $recentLogs = ActivityLog::latest()->take(5)->get(); // Adjust as needed

    return response()->json(view('admin.partials.activity_logs', compact('recentLogs'))->render());
}
}