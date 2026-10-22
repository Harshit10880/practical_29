@extends('layouts.app')

@section('title', 'About & System Architecture - Practical 16')
@section('page_title', 'About & System Architecture')
@section('page_subtitle', 'Technical specification, database schema, and MVC architectural components of this mini project.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start;">

    <div style="display: flex; flex-direction: column; gap: 24px;">

        <!-- Practical 16 Aim & Objective Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <span>📖</span> Practical 16: Mini Project Overview
                </h2>
                <span class="badge badge-purple">GPC Jamnagar Lab Manual</span>
            </div>
            <div class="card-body">
                <p style="font-size: 14.5px; color: #334155; line-height: 1.7; margin-bottom: 16px;">
                    <strong>AIM:</strong> To develop a complete web-based CRUD application using Laravel (mini project with 6–7 pages/modules) integrating user interface design, database management using migrations, and AI-assisted code generation tools.
                </p>

                <h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Implemented Pages &amp; Modules:</h3>
                <ul style="padding-left: 20px; font-size: 13.5px; color: #475569; line-height: 1.8;">
                    <li><strong>Page 1: Executive Dashboard (<code>/dashboard</code>)</strong> — Real-time student statistics, semester breakdown, and recent enrollments.</li>
                    <li><strong>Page 2: Student Directory (<code>/students</code>)</strong> — Complete read/list view with keyword search and semester filter.</li>
                    <li><strong>Page 3: Admission &amp; Registration (<code>/students/create</code>)</strong> — Full student data entry form with client &amp; server validation.</li>
                    <li><strong>Page 4: Student Profile (<code>/students/{id}</code>)</strong> — Detailed individual student record view with credentials card.</li>
                    <li><strong>Page 5: Update Student Record (<code>/students/{id}/edit</code>)</strong> — Pre-populated edit form supporting HTTP PUT updates.</li>
                    <li><strong>Page 6: Departments &amp; Courses (<code>/departments</code>)</strong> — Polytechnic branches, syllabus subjects, and intake capacity.</li>
                    <li><strong>Page 7: About &amp; Architecture (<code>/about</code>)</strong> — System architecture, database schema, and project metadata.</li>
                </ul>
            </div>
        </div>

        <!-- Database Schema Card -->
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <span>🗄️</span> Database Schema &amp; Migration
                </h2>
                <span class="badge badge-success">MySQL: practical12_db</span>
            </div>
            <div class="card-body">
                <p style="font-size: 13.5px; color: #64748b; margin-bottom: 14px;">
                    Defined in migration <code style="font-family: var(--font-mono); color: #4338ca;">create_students_table</code> and <code style="font-family: var(--font-mono); color: #4338ca;">add_academic_details_to_students_table</code>:
                </p>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1.5px solid var(--border-color); text-align: left;">
                                <th style="padding: 10px 14px; font-family: var(--font-mono);">Column</th>
                                <th style="padding: 10px 14px; font-family: var(--font-mono);">Type</th>
                                <th style="padding: 10px 14px;">Constraints / Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">id</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">bigint unsigned</td>
                                <td style="padding: 10px 14px;">Primary Key, Auto Increment</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">name</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(255)</td>
                                <td style="padding: 10px 14px;">Required, min 2 chars</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">enrollment_no</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(30)</td>
                                <td style="padding: 10px 14px;">Nullable, Student Roll ID</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">college</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(255)</td>
                                <td style="padding: 10px 14px;">Default: Government Polytechnic, Jamnagar</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">semester</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(20)</td>
                                <td style="padding: 10px 14px;">Semester 1 to Semester 6</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">subject</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(255)</td>
                                <td style="padding: 10px 14px;">Academic Branch / Subject</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">email</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(255)</td>
                                <td style="padding: 10px 14px;">Required, Unique Index</td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">phone</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">varchar(15)</td>
                                <td style="padding: 10px 14px;">Nullable, Phone Contact</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); font-weight: 700;">timestamps</td>
                                <td style="padding: 10px 14px; font-family: var(--font-mono); color: #6366f1;">timestamp</td>
                                <td style="padding: 10px 14px;">created_at &amp; updated_at</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Sidebar System Stats -->
    <div style="display: flex; flex-direction: column; gap: 20px;">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">⚙️ Tech Stack</h3>
            </div>
            <div class="card-body" style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span style="color: #64748b;">Framework:</span>
                    <strong style="color: #0f172a;">Laravel {{ app()->version() }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span style="color: #64748b;">PHP Engine:</span>
                    <strong style="color: #0f172a;">PHP {{ PHP_VERSION }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span style="color: #64748b;">Database:</span>
                    <strong style="color: #0f172a;">MySQL (InnoDB)</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span style="color: #64748b;">DB Name:</span>
                    <strong style="color: #4f46e5; font-family: var(--font-mono);">practical12_db</strong>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                    <span style="color: #64748b;">Templating:</span>
                    <strong style="color: #0f172a;">Laravel Blade</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #64748b;">Typography:</span>
                    <strong style="color: #0f172a;">Plus Jakarta Sans</strong>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">🏛️ Institution</h3>
            </div>
            <div class="card-body" style="font-size: 13.5px; line-height: 1.6; color: #334155;">
                <strong>Government Polytechnic, Jamnagar</strong><br>
                Computer Engineering Department<br>
                Vibe Coding Lab Manual 2026<br>
                <div style="margin-top: 12px;">
                    <span class="badge badge-success">Accredited by DTE / AICTE</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
