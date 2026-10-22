@extends('layouts.app')

@section('title', 'Dashboard - Student Management Mini Project')
@section('page_title', 'Academic Management Dashboard')
@section('page_subtitle', 'Overview of students, departments, and enrollment metrics for Government Polytechnic Jamnagar.')

@section('content')
<!-- Quick Stats Cards Row -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 28px;">
    <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; border-radius: 12px; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            👥
        </div>
        <div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1.1;">{{ $totalStudents }}</div>
            <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 2px;">Total Students</div>
        </div>
    </div>

    <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; border-radius: 12px; background: #ecfdf5; color: #059669; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            🏛️
        </div>
        <div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1.1;">5</div>
            <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 2px;">Polytechnic Branches</div>
        </div>
    </div>

    <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; border-radius: 12px; background: #ede9fe; color: #7c3aed; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            🎓
        </div>
        <div>
            <div style="font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1.1;">6</div>
            <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 2px;">Academic Semesters</div>
        </div>
    </div>

    <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
        <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; color: #b45309; display: flex; align-items: center; justify-content: center; font-size: 24px;">
            ⚡
        </div>
        <div>
            <div style="font-size: 22px; font-weight: 800; color: #0f172a; line-height: 1.1; font-family: var(--font-mono);">MySQL 8</div>
            <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase; margin-top: 2px;">practical12_db</div>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div style="display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start;">

    <!-- Recent Students Table Card -->
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">
                    <span>📋</span> Recent Student Enrollments
                </h2>
                <p style="font-size: 13px; color: var(--text-muted); margin-top: 3px;">Latest students registered in the MySQL database</p>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-outline btn-sm">
                View All Directory →
            </a>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left;">
                <thead>
                    <tr style="background: #f8fafc; font-size: 12px; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                        <th style="padding: 12px 18px; border-bottom: 1px solid var(--border-color);">Student</th>
                        <th style="padding: 12px 18px; border-bottom: 1px solid var(--border-color);">Roll / ID</th>
                        <th style="padding: 12px 18px; border-bottom: 1px solid var(--border-color);">Semester</th>
                        <th style="padding: 12px 18px; border-bottom: 1px solid var(--border-color);">Subject</th>
                        <th style="padding: 12px 18px; border-bottom: 1px solid var(--border-color); text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentStudents as $student)
                        <tr style="border-bottom: 1px solid var(--border-color); font-size: 13.5px;">
                            <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 34px; height: 34px; border-radius: 50%; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">
                                        {{ strtoupper(substr($student->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight: 700; color: #0f172a;">{{ $student->name }}</div>
                                        <div style="font-size: 11.5px; color: #64748b;">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color); font-family: var(--font-mono); font-size: 12px; color: #4f46e5;">
                                {{ $student->enrollment_no ?: 'N/A' }}
                            </td>
                            <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                                <span class="badge badge-purple">{{ $student->semester ?: 'General' }}</span>
                            </td>
                            <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                                <span class="badge badge-blue">{{ $student->subject ?: 'Core' }}</span>
                            </td>
                            <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color); text-align: right;">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline btn-sm">
                                    Profile →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 30px; text-align: center; color: #64748b;">
                                No students found. <a href="{{ route('students.create') }}" style="color: #4f46e5; font-weight: 700;">Add the first student</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Sidebar Quick Actions & Semesters -->
    <div style="display: flex; flex-direction: column; gap: 20px;">

        <!-- Quick Actions Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">⚡ Quick Operations</h3>
            </div>
            <div class="card-body" style="display: flex; flex-direction: column; gap: 10px;">
                <a href="{{ route('students.create') }}" class="btn btn-primary" style="width: 100%;">
                    <span>➕</span> Register New Student
                </a>
                <a href="{{ route('students.index') }}" class="btn btn-outline" style="width: 100%;">
                    <span>🔍</span> Search Student Records
                </a>
                <a href="{{ route('departments.index') }}" class="btn btn-outline" style="width: 100%;">
                    <span>🏛️</span> Browse Departments
                </a>
                <a href="{{ route('about') }}" class="btn btn-outline" style="width: 100%;">
                    <span>ℹ️</span> Practical 16 Docs &amp; Specs
                </a>
            </div>
        </div>

        <!-- Semester Breakdown Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">📊 Enrollment by Semester</h3>
            </div>
            <div class="card-body" style="display: flex; flex-direction: column; gap: 8px;">
                @foreach(['Semester 6', 'Semester 5', 'Semester 4', 'Semester 3', 'Semester 2', 'Semester 1'] as $sem)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 6px 0; border-bottom: 1px dashed var(--border-color); font-size: 13px;">
                        <span style="font-weight: 600; color: #334155;">{{ $sem }}</span>
                        <span class="badge badge-primary">{{ $semestersCount[$sem] ?? 0 }} students</span>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

</div>
@endsection
