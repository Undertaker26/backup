<?php

namespace App\Http\Controllers;

use App\Models\LiveVideo;
use Illuminate\Http\Request;

class LivesController extends Controller
{
    public function show()
    {
        // Assuming a single live video record
        $liveVideo = LiveVideo::first(); // Use first() to get the first record

        if ($liveVideo) {
            // Increment the view count
            $liveVideo->increment('views');
            $live_video_url = $liveVideo->video_url;
        } else {
            $live_video_url = null;
        }

        return view('live-stream', ['liveVideo' => $liveVideo]);
    }
}
