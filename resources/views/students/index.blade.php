@extends('layouts.app')

@section('title', 'Student Directory - Practical 16')
@section('page_title', 'Student Records Directory')
@section('page_subtitle', 'Browse, search, view, edit, and delete student records stored in MySQL database.')

@section('content')
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">
                <span>👥</span> All Enrolled Students
            </h2>
            <p style="font-size: 13px; color: var(--text-muted); margin-top: 3px;">
                Retrieved dynamically from <code style="font-family: var(--font-mono); color: #4338ca;">practical12_db.students</code>
            </p>
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <div class="badge badge-primary" style="font-size: 13px; padding: 6px 12px;">
                {{ $students->count() }} Total Records
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                <span>➕</span> Add Student
            </a>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <form action="{{ route('students.index') }}" method="GET" style="padding: 14px 20px; background: #f8fafc; border-bottom: 1px solid var(--border-color); display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
        <div style="position: relative; flex: 1; min-width: 200px;">
            <svg style="position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); pointer-events: none;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input 
                type="text" 
                name="search" 
                style="width: 100%; padding: 9px 12px 9px 36px; font-family: var(--font-main); font-size: 13px; color: var(--text-main); background: #ffffff; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none;" 
                placeholder="Search name, roll no, email, subject..." 
                value="{{ request('search') }}"
            >
        </div>

        <select name="semester" style="padding: 9px 28px 9px 12px; font-family: var(--font-main); font-size: 13px; color: var(--text-main); background: #ffffff; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none; cursor: pointer;">
            <option value="">All Semesters</option>
            @foreach(['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'] as $sem)
                <option value="{{ $sem }}" {{ request('semester') == $sem ? 'selected' : '' }}>
                    {{ $sem }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary btn-sm">Search</button>

        @if(request('search') || request('semester'))
            <a href="{{ route('students.index') }}" class="btn btn-outline btn-sm">
                ✕ Reset Filters
            </a>
        @endif
    </form>

    <!-- Table -->
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; font-size: 12px; text-transform: uppercase; color: #64748b; letter-spacing: 0.05em;">
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color); width: 60px;">ID</th>
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color);">Student Details</th>
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color);">College</th>
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color);">Academic Branch</th>
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color);">Contact</th>
                    <th style="padding: 13px 18px; border-bottom: 1px solid var(--border-color); text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr style="border-bottom: 1px solid var(--border-color); font-size: 13.5px;">
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                            <span style="font-family: var(--font-mono); font-size: 12px; font-weight: 600; padding: 2px 7px; background: #f1f5f9; color: #475569; border-radius: 4px; border: 1px solid #e2e8f0;">
                                #{{ $student->id }}
                            </span>
                        </td>
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0;">
                                    {{ strtoupper(substr($student->name, 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 700; color: #0f172a;">{{ $student->name }}</div>
                                    @if($student->enrollment_no)
                                        <div style="font-family: var(--font-mono); font-size: 11.5px; color: #4f46e5; font-weight: 600;">
                                            Roll: {{ $student->enrollment_no }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                            <div style="font-weight: 600; color: #334155; font-size: 13px;">
                                {{ $student->college ?: 'GPC Jamnagar' }}
                            </div>
                            <div style="font-size: 11.5px; color: #94a3b8;">
                                Joined {{ $student->created_at ? $student->created_at->format('d M Y') : 'N/A' }}
                            </div>
                        </td>
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                            <div style="display: flex; flex-direction: column; gap: 4px; align-items: flex-start;">
                                @if($student->semester)
                                    <span class="badge badge-purple">🎓 {{ $student->semester }}</span>
                                @endif
                                @if($student->subject)
                                    <span class="badge badge-blue">📖 {{ $student->subject }}</span>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color);">
                            <div style="font-size: 13px; color: #0f172a; font-weight: 500;">{{ $student->email }}</div>
                            @if($student->phone)
                                <div style="font-family: var(--font-mono); font-size: 12px; color: #64748b; margin-top: 2px;">
                                    📞 {{ $student->phone }}
                                </div>
                            @endif
                        </td>
                        <td style="padding: 14px 18px; border-bottom: 1px solid var(--border-color); text-align: right;">
                            <div style="display: inline-flex; align-items: center; gap: 6px;">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline btn-sm" title="View Student Profile">
                                    👁️ View
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline btn-sm" style="color: #4f46e5; border-color: #c7d2fe;" title="Edit Student">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete student #{{ $student->id }} ({{ $student->name }})?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline" style="color: #ef4444; border-color: #fecaca;" title="Delete Record">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 50px 20px; text-align: center;">
                            <div style="font-size: 32px; margin-bottom: 10px;">📂</div>
                            <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">No Students Found</h3>
                            <p style="font-size: 13.5px; color: #64748b; margin-bottom: 16px;">
                                @if(request('search') || request('semester'))
                                    No records matched your search query. Try clearing filters.
                                @else
                                    There are currently no students registered in the database.
                                @endif
                            </p>
                            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm">
                                ➕ Register First Student
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
