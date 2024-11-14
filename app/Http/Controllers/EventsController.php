<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    // Constructor to restrict access
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated for all routes
    }

    // Display a listing of events for users
    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }
}
