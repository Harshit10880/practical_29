<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * Display a listing of students with search and filter.
     */
    public function index(Request $request): View
    {
        $query = Student::query();

        // Search query filter
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('enrollment_no', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        // Semester filter
        if ($request->filled('semester')) {
            $query->where('semester', $request->input('semester'));
        }

        $students = $query->latest()->get();

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student record.
     */
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created student record in the MySQL database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|min:2|max:255',
            'enrollment_no' => 'nullable|string|max:30',
            'college'       => 'nullable|string|max:255',
            'semester'      => 'nullable|string|max:20',
            'subject'       => 'nullable|string|max:255',
            'email'         => 'required|email|max:255|unique:students,email',
            'phone'         => 'nullable|string|max:15',
        ], [
            'name.required'     => 'Student full name is required.',
            'name.min'          => 'Full name must be at least 2 characters.',
            'email.required'    => 'Student email address is required.',
            'email.email'       => 'Please provide a valid email address.',
            'email.unique'      => 'This email address is already registered in the system.',
            'phone.max'         => 'Phone number cannot exceed 15 characters.',
            'enrollment_no.max' => 'Enrollment number cannot exceed 30 characters.',
        ]);

        $student = Student::create($validated);

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student record has been successfully added to MySQL database!');
    }

    /**
     * Display the specified student profile.
     */
    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student record.
     */
    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student record in the MySQL database.
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => 'required|string|min:2|max:255',
            'enrollment_no' => 'nullable|string|max:30',
            'college'       => 'nullable|string|max:255',
            'semester'      => 'nullable|string|max:20',
            'subject'       => 'nullable|string|max:255',
            'email'         => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone'         => 'nullable|string|max:15',
        ], [
            'name.required'     => 'Student full name is required.',
            'name.min'          => 'Full name must be at least 2 characters.',
            'email.required'    => 'Student email address is required.',
            'email.email'       => 'Please provide a valid email address.',
            'email.unique'      => 'This email address is already registered by another student.',
            'phone.max'         => 'Phone number cannot exceed 15 characters.',
            'enrollment_no.max' => 'Enrollment number cannot exceed 30 characters.',
        ]);

        $student->update($validated);

        return redirect()
            ->route('students.show', $student->id)
            ->with('success', 'Student details updated successfully in MySQL!');
    }

    /**
     * Remove the specified student record from the database.
     */
    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record was removed successfully from MySQL database.');
    }
}