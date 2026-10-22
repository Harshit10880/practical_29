@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
@extends('layouts.app')

@section('title', 'Edit ' . $student->name . ' - Practical 16')
@section('page_title', 'Update Student Details')
@section('page_subtitle', 'Modify academic and contact records for student #' . $student->id . ' in MySQL.')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">
                    <span>✏️</span> Edit Student #{{ $student->id }}
                </h2>
                <p style="font-size: 13px; color: var(--text-muted); margin-top: 3px;">
                    Update the values below and click Save Changes to persist them in MySQL.
                </p>
            </div>
            <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline btn-sm">
                ← View Profile
            </a>
        </div>

        <div class="card-body">
            <!-- Errors Alert -->
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

            <form action="{{ route('students.update', $student->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

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
                            value="{{ old('name', $student->name) }}" 
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
                            value="{{ old('enrollment_no', $student->enrollment_no) }}" 
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
                        value="{{ old('college', $student->college) }}" 
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
                                <option value="{{ $sem }}" {{ old('semester', $student->semester) == $sem ? 'selected' : '' }}>
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
                            value="{{ old('subject', $student->subject) }}" 
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
                            value="{{ old('email', $student->email) }}" 
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
                            value="{{ old('phone', $student->phone) }}" 
                            maxlength="15" 
                            style="width: 100%; padding: 11px 14px; font-family: var(--font-main); font-size: 13.5px; border: 1.5px solid var(--border-color); border-radius: var(--radius-sm); outline: none;"
                        >
                    </div>
                </div>

                <!-- Actions -->
                <div style="display: flex; justify-content: flex-end; align-items: center; border-top: 1px solid var(--border-color); padding-top: 20px; gap: 12px;">
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <span>💾</span> Update Student Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
