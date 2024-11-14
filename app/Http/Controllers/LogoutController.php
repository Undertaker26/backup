<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Clear the live video view session flag
        $request->session()->forget('live_video_viewed');
        
        // Perform the logout
        Auth::logout();
        
        // Redirect or other logout actions
        return redirect('/login');
    }
    }
