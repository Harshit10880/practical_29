<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the mini-project executive dashboard.
     */
    public function index(): View
    {
        $totalStudents = Student::count();
        $recentStudents = Student::latest()->take(5)->get();

        $semestersCount = Student::whereNotNull('semester')
            ->selectRaw('semester, count(*) as count')
            ->groupBy('semester')
            ->pluck('count', 'semester')
            ->toArray();

        return view('dashboard', compact('totalStudents', 'recentStudents', 'semestersCount'));
    }
}
