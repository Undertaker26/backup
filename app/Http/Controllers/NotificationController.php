<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
    public function index()
    {
        // Fetch notifications for the authenticated user
        $notifications = auth()->user()->notifications()->latest()->get();

        // Return a view to display the notifications
        return view('notifications.index', compact('notifications'));
    }

    public function like(Post $post)
    {
        // Code to handle like action...

        // Create notification
        Notification::create([
            'user_id' => $post->user_id, // The post owner
            'trigger_user_id' => auth()->id(), // The user who liked
            'post_id' => $post->id,
            'type' => 'like',
        ]);
    }

    public function comment(Post $post)
    {
        // Code to handle comment action...

        // Create notification
        Notification::create([
            'user_id' => $post->user_id, // The post owner
            'trigger_user_id' => auth()->id(), // The user who commented
            'post_id' => $post->id,
            'type' => 'comment',
        ]);
    }

    public function share(Post $post)
    {
        // Code to handle share action...

        // Create notification
        Notification::create([
            'user_id' => $post->user_id, // The post owner
            'trigger_user_id' => auth()->id(), // The user who shared
            'post_id' => $post->id,
            'type' => 'share',
        ]);
    }

    public function markAsRead()
    {
        auth()->user()->notifications()->update(['is_read' => true]);
    
        return back();
    }
}
