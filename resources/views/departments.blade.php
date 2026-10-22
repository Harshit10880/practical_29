@extends('layouts.app')

@section('title', 'Departments & Courses - Practical 16')
@section('page_title', 'Academic Departments & Course Tracks')
@section('page_subtitle', 'Browse Government Polytechnic Jamnagar academic branches, intake capacities, and semester subjects.')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px;">
    @foreach($departments as $dept)
        <div class="card" style="display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <div class="card-header" style="background: #ffffff;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 44px; height: 44px; border-radius: 12px; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-size: 22px;">
                            {{ $dept['icon'] }}
                        </div>
                        <div>
                            <h2 style="font-size: 17px; font-weight: 800; color: #0f172a; letter-spacing: -0.02em;">
                                {{ $dept['name'] }}
                            </h2>
                            <span class="badge badge-primary" style="font-family: var(--font-mono); margin-top: 2px;">
                                Code: {{ $dept['code'] }}
                            </span>
                        </div>
                    </div>

                    <span class="badge badge-success">
                        Intake: {{ $dept['intake'] }}
                    </span>
                </div>

                <div class="card-body">
                    <p style="font-size: 13.5px; color: #475569; line-height: 1.6; margin-bottom: 16px;">
                        {{ $dept['description'] }}
                    </p>

                    <h4 style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">
                        Key Subjects &amp; Labs:
                    </h4>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                        @foreach($dept['subjects'] as $subj)
                            <span class="badge badge-blue">
                                {{ $subj }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: 12px; color: #64748b; font-weight: 600;">
                    3-Year Diploma Course
                </span>
                <a href="{{ route('students.index', ['search' => $dept['name']]) }}" class="btn btn-outline btn-sm">
                    View Students →
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
