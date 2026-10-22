<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DepartmentController extends Controller
{
    /**
     * Display the Polytechnic departments and courses module.
     */
    public function index(): View
    {
        $departments = [
            [
                'code' => 'CE',
                'name' => 'Computer Engineering',
                'icon' => '💻',
                'description' => 'Focuses on software engineering, web development (Laravel/PHP), database administration, and algorithms.',
                'intake' => 120,
                'subjects' => ['Vibe Coding (Laravel)', 'Web Technologies', 'Database Management', 'Operating Systems', 'Data Structures']
            ],
            [
                'code' => 'IT',
                'name' => 'Information Technology',
                'icon' => '🌐',
                'description' => 'Specializes in computer networks, cloud computing, cybersecurity, and enterprise web solutions.',
                'intake' => 60,
                'subjects' => ['Cloud Computing', 'Cyber Security', 'Network Protocols', 'Python Programming', 'Software Testing']
            ],
            [
                'code' => 'ME',
                'name' => 'Mechanical Engineering',
                'icon' => '⚙️',
                'description' => 'Deals with industrial manufacturing, CAD/CAM design, thermodynamics, and automation.',
                'intake' => 120,
                'subjects' => ['Thermodynamics', 'Fluid Mechanics', 'Manufacturing Processes', 'CAD/CAM Modeling']
            ],
            [
                'code' => 'EE',
                'name' => 'Electrical Engineering',
                'icon' => '⚡',
                'description' => 'Covers power transmission, electrical circuit theory, power electronics, and IoT microcontrollers.',
                'intake' => 60,
                'subjects' => ['Circuit Analysis', 'Power Systems', 'Microcontrollers', 'Control Systems']
            ],
            [
                'code' => 'CL',
                'name' => 'Civil Engineering',
                'icon' => '🏗️',
                'description' => 'Focuses on structural engineering, surveying, building planning, and environmental engineering.',
                'intake' => 60,
                'subjects' => ['Structural Analysis', 'Surveying Techniques', 'Concrete Technology', 'Hydrology']
            ]
        ];

        return view('departments', compact('departments'));
    }
}
