@extends('layouts.app')

@section('title', $student->name . ' - Student Profile')
@section('page_title', 'Student Profile Card')
@section('page_subtitle', 'Comprehensive view of academic and contact credentials retrieved from MySQL.')

@section('content')
<div style="max-width: 850px; margin: 0 auto;">
    <div class="card" style="margin-bottom: 24px;">
        <!-- Card Top Header -->
        <div style="padding: 28px; background: linear-gradient(135deg, #1e1b4b, #312e81, #4338ca); color: white; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 18px;">
                <div style="width: 64px; height: 64px; border-radius: 50%; background: #ffffff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 800; box-shadow: 0 4px 14px rgba(0,0,0,0.2);">
                    {{ strtoupper(substr($student->name, 0, 2)) }}
                </div>
                <div>
                    <h2 style="font-size: 22px; font-weight: 800; letter-spacing: -0.02em;">{{ $student->name }}</h2>
                    <div style="display: flex; align-items: center; gap: 10px; margin-top: 4px; font-size: 13px; color: #c7d2fe;">
                        <span>Record #{{ $student->id }}</span>
                        <span>•</span>
                        <span style="font-family: var(--font-mono);">Roll: {{ $student->enrollment_no ?: 'Unassigned' }}</span>
                    </div>
                </div>
            </div>

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm" style="background: #ffffff; color: #4338ca; box-shadow: none;">
                    ✏️ Edit Record
                </a>
                <a href="{{ route('students.index') }}" class="btn btn-outline btn-sm" style="color: white; border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.1);">
                    ← Directory
                </a>
            </div>
        </div>

        <!-- Academic & Personal Grid -->
        <div class="card-body">
            <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span>🏫</span> Academic Credentials
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">College / Institute</div>
                    <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; margin-top: 4px;">
                        {{ $student->college ?: 'Government Polytechnic, Jamnagar' }}
                    </div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Current Semester</div>
                    <div style="margin-top: 6px;">
                        <span class="badge badge-purple" style="font-size: 13px;">
                            🎓 {{ $student->semester ?: 'Not Specified' }}
                        </span>
                    </div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Subject / Branch</div>
                    <div style="margin-top: 6px;">
                        <span class="badge badge-blue" style="font-size: 13px;">
                            📖 {{ $student->subject ?: 'Core Polytechnic' }}
                        </span>
                    </div>
                </div>
            </div>

            <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <span>📞</span> Contact &amp; System Information
            </h3>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 24px;">
                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Official Email</div>
                    <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; margin-top: 4px;">
                        {{ $student->email }}
                    </div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Phone Number</div>
                    <div style="font-size: 14.5px; font-weight: 700; color: #0f172a; margin-top: 4px; font-family: var(--font-mono);">
                        {{ $student->phone ?: 'Not provided' }}
                    </div>
                </div>

                <div style="padding: 16px; background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                    <div style="font-size: 12px; font-weight: 600; color: #64748b; text-transform: uppercase;">Registered At</div>
                    <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-top: 4px;">
                        {{ $student->created_at ? $student->created_at->format('d M Y, h:i A') : 'N/A' }}
                    </div>
                </div>
            </div>

            <!-- Danger Zone: Delete -->
            <div style="border-top: 1px solid var(--border-color); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <span style="font-size: 13px; color: #64748b;">
                    Last updated: {{ $student->updated_at ? $student->updated_at->diffForHumans() : 'N/A' }}
                </span>

                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete student #{{ $student->id }} ({{ $student->name }}) from MySQL?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        🗑️ Delete Student Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
