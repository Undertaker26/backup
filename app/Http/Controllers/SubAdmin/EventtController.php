<?php
namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventtController extends Controller
{
    // Constructor to restrict access to admin users for admin routes
    public function __construct()
    {
        $this->middleware('auth'); // Ensure user is authenticated for all routes
        $this->middleware('subadmin')->only(['create', 'store', 'edit', 'update', 'destroy']); // Only admins can access these actions
    }

    // Display a listing of events for admins
    // public function index()
    // {
    //     $events = Event::all();
    //     return view('admin.events.index', compact('events'));
    // }
    public function index(Request $request)
    {
        $events = Event::all();
        // return view('admin.events.index', compact('events'));

        $sort = $request->input('sort');
    
        switch ($sort) {
            case 'latest_date':
                $events = Event::orderBy('date', 'desc')->get();
                break;
            case 'oldest_date':
                $events = Event::orderBy('date', 'asc')->get();
                break;
            case 'a_z':
                $events = Event::orderBy('title', 'asc')->get();
                break;
            case 'z_a':
                $events = Event::orderBy('title', 'desc')->get();
                break;
            default:
                $events = Event::all();
        }
    
        return view('subadmin.event.index', compact('events'));
    }
    
    // Show the form for creating a new event
    public function create()
    {
        return view('subadmin.event.create');
    }

    // Store a newly created event in storage
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Event::create($request->all());

        return redirect()->route('subadmin.event.index')->with('success', 'Event created successfully.');
    }

    // Show the form for editing the specified event
    
    public function edit(Event $event)
    {
        return view('subadmin.event.edit', compact('event'));
    }

    // Update the specified event in storage
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $event->update($request->all());

        return redirect()->route('subadmin.event.index')->with('success', 'Event updated successfully.');
    }

    // Remove the specified event from storage
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('subadmin.event.index')->with('success', 'Event deleted successfully.');
    }
}
