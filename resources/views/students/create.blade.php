@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
@extends('layouts.app')

@section('title', 'Add Student - Practical 16')
@section('page_title', 'New Student Admission & Registration')
@section('page_subtitle', 'Enter student academic and personal credentials to store a new record in MySQL.')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">
                    <span>✍️</span> Student Registration Form
                </h2>
                <p style="font-size: 13px; color: var(--text-muted); margin-top: 3px;">
                    Fill all required details below to create an official student record in MySQL.
                </p>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-outline btn-sm">
                ← Back to Directory
            </a>
        </div>

        <div class="card-body">
            <!-- Validation Summary Alert -->
            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <div class="alert-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div class="alert-body">
                        <strong>Please resolve the following input errors:</strong>
                        <ul style="margin-top: 6px; padding-left: 18px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST" id="createStudentForm" novalidate>
                @csrf

                <!-- Row 1: Name and Enrollment No -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label for="name" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Student Full Name <span style="color: #ef4444;">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            placeholder="e.g. Aarav Patel" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid {{ $errors->has('name') ? '#ef4444' : 'var(--border-color)' }}; border-radius: var(--radius-sm); outline: none;" 
                            required 
                            autofocus
                        >
                        @error('name')
                            <div style="font-size: 12px; color: #ef4444; margin-top: 4px; font-weight: 600;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="enrollment_no" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Enrollment / Student ID
                        </label>
                        <input 
                            type="text" 
                            id="enrollment_no" 
                            name="enrollment_no" 
                            value="{{ old('enrollment_no') }}" 
                            placeholder="e.g. 236250307001" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid {{ $errors->has('enrollment_no') ? '#ef4444' : 'var(--border-color)' }}; border-radius: var(--radius-sm); outline: none;"
                        >
                        @error('enrollment_no')
                            <div style="font-size: 12px; color: #ef4444; margin-top: 4px; font-weight: 600;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- College -->
                <div style="margin-bottom: 16px;">
                    <label for="college" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                        College / Institute Name
                    </label>
                    <input 
                        type="text" 
                        id="college" 
                        name="college" 
                        value="{{ old('college', 'Government Polytechnic, Jamnagar') }}" 
                        placeholder="e.g. Government Polytechnic, Jamnagar" 
                        style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none;"
                    >
                </div>

                <!-- Row 2: Semester & Subject -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                    <div>
                        <label for="semester" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Semester
                        </label>
                        <select 
                            id="semester" 
                            name="semester" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none; background: #ffffff; cursor: pointer;"
                        >
                            <option value="">Select Semester</option>
                            @foreach(['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'] as $sem)
                                <option value="{{ $sem }}" {{ old('semester', 'Semester 6') == $sem ? 'selected' : '' }}>
                                    {{ $sem }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="subject" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Subject / Branch
                        </label>
                        <input 
                            type="text" 
                            id="subject" 
                            name="subject" 
                            value="{{ old('subject', 'Vibe Coding (Laravel)') }}" 
                            placeholder="e.g. Vibe Coding (Laravel)" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none;"
                        >
                    </div>
                </div>

                <!-- Row 3: Email & Phone -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 24px;">
                    <div>
                        <label for="email" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Email Address <span style="color: #ef4444;">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            placeholder="e.g. aarav.patel@gpcjamnagar.edu.in" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid {{ $errors->has('email') ? '#ef4444' : 'var(--border-color)' }}; border-radius: var(--radius-sm); outline: none;" 
                            required
                        >
                        @error('email')
                            <div style="font-size: 12px; color: #ef4444; margin-top: 4px; font-weight: 600;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #0f172a;">
                            Phone Number <span style="font-size: 12px; font-weight: 400; color: #64748b;">(Optional)</span>
                        </label>
                        <input 
                            type="text" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            placeholder="e.g. +91 98765 43210" 
                            maxlength="15" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none;"
                        >
                    </div>
                </div>

                <!-- Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-color); padding-top: 20px; flex-wrap: wrap; gap: 12px;">
                    <div style="display: flex; gap: 10px;">
                        <button type="button" class="btn btn-outline btn-sm" onclick="quickFillDemo()">
                            ⚡ Quick Fill Demo Data
                        </button>
                        <button type="button" class="btn btn-outline btn-sm" onclick="clearForm()">
                            ✕ Reset Form
                        </button>
                    </div>

                    <div style="display: flex; gap: 12px;">
                        <a href="{{ route('students.index') }}" class="btn btn-outline">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <span>💾</span> Save Student to MySQL
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const sampleStudents = [
        { name: 'Kishan Dave', enrollment_no: '236250307055', college: 'Government Polytechnic, Jamnagar', semester: 'Semester 6', subject: 'Vibe Coding (Laravel)', email: 'kishan.dave@gpcjamnagar.edu.in', phone: '+91 98241 11223' },
        { name: 'Meera Trivedi', enrollment_no: '236250307062', college: 'Government Polytechnic, Jamnagar', semester: 'Semester 6', subject: 'Cloud & DevOps', email: 'meera.trivedi@gpcjamnagar.edu.in', phone: '+91 94262 33445' },
        { name: 'Rohan Rathod', enrollment_no: '236250307078', college: 'Government Polytechnic, Jamnagar', semester: 'Semester 4', subject: 'Database Management', email: 'rohan.rathod@gpcjamnagar.edu.in', phone: '+91 99099 55667' }
    ];
    let sampleIdx = 0;

    function quickFillDemo() {
        const sample = sampleStudents[sampleIdx % sampleStudents.length];
        const randomNum = Math.floor(Math.random() * 900 + 100);
        const emailParts = sample.email.split('@');
        const uniqueEmail = emailParts[0] + randomNum + '@' + emailParts[1];

        document.getElementById('name').value = sample.name;
        document.getElementById('enrollment_no').value = sample.enrollment_no;
        document.getElementById('college').value = sample.college;
        document.getElementById('semester').value = sample.semester;
        document.getElementById('subject').value = sample.subject;
        document.getElementById('email').value = uniqueEmail;
        document.getElementById('phone').value = sample.phone;
        sampleIdx++;

        document.getElementById('name').focus();
    }

    function clearForm() {
        document.getElementById('name').value = '';
        document.getElementById('enrollment_no').value = '';
        document.getElementById('college').value = 'Government Polytechnic, Jamnagar';
        document.getElementById('semester').value = 'Semester 6';
        document.getElementById('subject').value = 'Vibe Coding (Laravel)';
        document.getElementById('email').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('name').focus();
    }
</script>
@endsection
