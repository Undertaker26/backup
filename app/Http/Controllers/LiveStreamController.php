<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveStreamController extends Controller
{
    public function showLiveStream()
    {
        $liveStreamer = 'Streamer Name'; // Replace with actual name fetching logic
        return view('live', compact('liveStreamer'));
    }

}
