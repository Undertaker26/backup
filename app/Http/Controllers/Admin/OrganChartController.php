<?php

// app/Http/Controllers/Admin/OrganChartController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use Illuminate\Support\Facades\Storage;

class OrganChartController extends Controller
{
    private $positions = [
        'BOARDS OF REGENT' => [
            'Acting University President',
            'Chief Operating Officer',
            'Acting Board Secretary',
            'OIC-Office of the Vice President for Administrative Affairs',
            'Director, Center for Student Leadership and Development'
        ],
        'UNIVERSITY OF SCRIBE' => [
            'Adviser',
            'Editor-In-Chief',
            'Associate Editor',
            'Managing Editor',
            'Circulation Manager',
            'Features and Literacy Editor',
            'Editorial Cartoonist'
        ],
        'STAFF' => [
            'Senior Staff',
            'Junior Staff'
        ]
    ];

    public function index()
    {
        $organizations = Organization::with('children')->whereNull('parent_id')->get();
        return view('admin.organ_chart.index', compact('organizations'));
    }

    public function create()
    {
        $organizations = Organization::all();
        return view('admin.organ_chart.create', ['organizations' => $organizations, 'positions' => $this->positions]);
    }

// app/Http/Controllers/Admin/OrganChartController.php
public function store(Request $request)
{
    $request->validate([
        'name' => 'nullable',
        'position' => 'required',
        'parent_id' => 'nullable|exists:organizations,id',
        'image' => 'nullable|image|max:2048',
        'category' => 'required|in:BOARDS OF REGENT,UNIVERSITY OF SCRIBE,STAFF',
    ]);

    $data = $request->all();
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    Organization::create($data);
    return redirect()->route('admin.organ_chart.index')->with('success', 'Organization added successfully.');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'position' => 'required',
        'parent_id' => 'nullable|exists:organizations,id',
        'image' => 'nullable|image|max:2048',
        'category' => 'required|in:BOARDS OF REGENT,UNIVERSITY OF SCRIBE,STAFF',
    ]);

    $organization = Organization::findOrFail($id);
    $data = $request->all();
    if ($request->hasFile('image')) {
        if ($organization->image) {
            Storage::disk('public')->delete($organization->image);
        }
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    $organization->update($data);
    return redirect()->route('admin.organ_chart.index')->with('success', 'Organization updated successfully.');
}
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);
        $organizations = Organization::all();
        return view('admin.organ_chart.edit', ['organization' => $organization, 'organizations' => $organizations, 'positions' => $this->positions]);
    }

    
    public function destroy($id)
    {
        $organization = Organization::findOrFail($id);
        if ($organization->image) {
            Storage::disk('public')->delete($organization->image);
        }
        $organization->delete();
        return redirect()->route('admin.organ_chart.index')->with('success', 'Organization deleted successfully.');
    }
}
