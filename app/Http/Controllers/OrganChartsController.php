<?php

// app/Http/Controllers/OrganChartsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganChartsController extends Controller
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
        $categories = array_keys($this->positions);

        $organizations = [];
        foreach ($categories as $category) {
            $organizations[$category] = Organization::where('category', $category)
                ->with('children')
                ->whereNull('parent_id')
                ->get();
        }

        return view('organation.index', compact('organizations'));
    }
}
