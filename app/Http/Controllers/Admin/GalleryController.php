<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery; // Assuming you have a Gallery model
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $items = Gallery::all();
        return view('admin.gallery.index', compact('items'));
    }

    public function showGallery()
{
    $items = Gallery::all();
    return view('gallery', compact('items'));
}

public function store(Request $request)
{
    try {
        $request->validate([
            // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,mkv|max:51200',
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,mkv|max:204800',

            // 'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('gallery', 'public');

        Gallery::create([
            'file_path' => $path,
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'File uploaded successfully.');
    } catch (\Exception $e) {
        \Log::error('File upload failed: ' . $e->getMessage());
        return redirect()->route('admin.gallery.index')->with('error', 'File upload failed.');
    }
}

    public function destroy(Gallery $items)
    {
        $items->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'File deleted successfully.');
    }
}
