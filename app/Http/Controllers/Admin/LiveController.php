<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LiveController extends Controller
{
    public function create()
    {
        $liveVideo = LiveVideo::latest()->first();
        return view('admin.live.create', compact('liveVideo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_url' => 'required|url',
        ]);

        $url = $request->input('video_url');
        $parsedUrl = parse_url($url);
        $videoId = '';

        if (isset($parsedUrl['host'])) {
            if ($parsedUrl['host'] === 'www.youtube.com' && isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $query);
                $videoId = $query['v'] ?? '';
            } elseif ($parsedUrl['host'] === 'youtu.be' && isset($parsedUrl['path'])) {
                $videoId = trim($parsedUrl['path'], '/');
            }
        }

        if ($videoId) {
            $url = "https://www.youtube.com/embed/{$videoId}";
        } else {
            return redirect()->route('admin.live.create')->withErrors('Invalid video URL');
        }

        // Create a new live video record
        try {
            LiveVideo::create([
                'video_url' => $url,
                'views' => 0
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create live video: ' . $e->getMessage());
            return redirect()->route('admin.live.create')->withErrors('Failed to create live video.');
        }

        return redirect()->route('admin.live.create')->with('success', 'Live video link created successfully!');
    }

    public function endLiveStream()
    {
        try {
            $liveVideo = LiveVideo::latest()->first();
            if ($liveVideo) {
                $liveVideo->delete();
            }
        } catch (\Exception $e) {
            Log::error('Failed to end live stream: ' . $e->getMessage());
            return redirect()->route('admin.live.create')->withErrors('Failed to end live stream.');
        }

        return redirect()->route('admin.live.create')->with('success', 'Live stream ended successfully!');
    }
}

