<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        // Check if PIN is enabled and not yet verified
        if (Session::get('pin_enabled') && !Session::get('pin_verified')) {
            return redirect()->route('admin.pin.verify.form');
        }

        if ($user->usertype == 'admin') {
            return view('admin.dashboard'); // Admin dashboard view
        } elseif ($user->usertype == 'subadmin') {
            return view('subadmin.subdashboard'); // Subadmin dashboard view
        }
    }
}
