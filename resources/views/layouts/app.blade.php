@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GPC EduPortal - Student Management Mini Project') | GPC Jamnagar</title>

    <!-- Tailwind CSS CDN for Practical 8 Reusable Blade System -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #eef2ff;
            --primary-border: #c7d2fe;
            
            --secondary: #7c3aed;
            --accent: #06b6d4;
            
            --success: #10b981;
            --success-light: #ecfdf5;
            --success-border: #a7f3d0;
            
            --danger: #ef4444;
            --danger-light: #fef2f2;
            --danger-border: #fecaca;

            --warning: #f59e0b;
            --warning-light: #fffbeb;
            
            --bg-canvas: #f8fafc;
            --bg-card: #ffffff;
            
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-subtle: #94a3b8;
            
            --border-color: #e2e8f0;
            --border-focus: #818cf8;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 25px -3px rgba(15, 23, 42, 0.08), 0 4px 6px -4px rgba(15, 23, 42, 0.04);
            --shadow-xl: 0 20px 35px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.05);
            
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 18px;
            --radius-full: 9999px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-canvas);
            color: var(--text-main);
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Bar */
        .top-navbar {
            background: #0f172a;
            color: #f8fafc;
            padding: 14px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(10px);
        }

        .brand-group {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
            color: white;
            font-size: 20px;
            font-weight: 800;
        }

        .brand-info h1 {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-info p {
            font-size: 11.5px;
            color: #94a3b8;
            font-weight: 500;
        }

        .nav-badge-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .practical-pill {
            background: rgba(99, 102, 241, 0.2);
            border: 1px solid rgba(129, 140, 248, 0.4);
            color: #c7d2fe;
            padding: 4px 12px;
            border-radius: var(--radius-full);
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .practical-pill::before {
            content: '';
            width: 7px;
            height: 7px;
            background: #818cf8;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 8px #818cf8;
        }

        .db-status-pill {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(52, 211, 153, 0.3);
            color: #6ee7b7;
            padding: 4px 11px;
            border-radius: var(--radius-full);
            font-size: 11.5px;
            font-family: var(--font-mono);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .db-dot {
            width: 7px;
            height: 7px;
            background: #10b981;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 8px #10b981;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
            100% { opacity: 1; transform: scale(1); }
        }

        /* Sub Navigation Menu */
        .sub-nav {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 0 6%;
            display: flex;
            align-items: center;
            gap: 6px;
            overflow-x: auto;
        }

        .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 16px;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-muted);
            text-decoration: none;
            border-bottom: 2.5px solid transparent;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .nav-link:hover {
            color: var(--primary);
            background: #f8fafc;
        }

        .nav-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
            font-weight: 700;
        }

        /* Page Banner Header */
        .page-banner {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
            color: white;
            padding: 38px 6% 44px;
            position: relative;
            overflow: hidden;
        }

        .page-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 450px;
            height: 450px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.25) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .banner-content {
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .lab-badge {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a5b4fc;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .page-banner h1 {
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.03em;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .page-banner p {
            font-size: 14.5px;
            color: #e0e7ff;
            max-width: 780px;
            line-height: 1.6;
        }

        /* Main Workspace */
        .workspace {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            padding: 30px 6% 60px;
            flex: 1;
        }

        /* Cards */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 24px;
        }

        /* Flash Alerts */
        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 22px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background-color: var(--success-light);
            border: 1px solid var(--success-border);
            color: #065f46;
        }

        .alert-danger {
            background-color: var(--danger-light);
            border: 1px solid var(--danger-border);
            color: #991b1b;
        }

        .alert-icon {
            font-size: 18px;
            line-height: 1;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .alert-body {
            flex: 1;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            font-family: var(--font-main);
            font-size: 13.5px;
            font-weight: 700;
            border-radius: var(--radius-sm);
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
            filter: brightness(1.05);
        }

        .btn-outline {
            background: #ffffff;
            color: var(--text-main);
            border: 1.5px solid var(--border-color);
        }

        .btn-outline:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12.5px;
            border-radius: 6px;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 600;
        }

        .badge-primary { background: var(--primary-light); color: var(--primary); border: 1px solid var(--primary-border); }
        .badge-success { background: var(--success-light); color: #047857; border: 1px solid var(--success-border); }
        .badge-warning { background: var(--warning-light); color: #b45309; border: 1px solid #fde68a; }
        .badge-purple { background: #ede9fe; color: #6b21a8; border: 1px solid #ddd6fe; }
        .badge-blue { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }

        /* Footer */
        footer {
            margin-top: auto;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 24px 6%;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }

        footer strong {
            color: var(--text-main);
        }

        @media (max-width: 768px) {
            .top-navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .nav-badge-group {
                width: 100%;
                justify-content: space-between;
            }
            .sub-nav {
                padding: 0 4%;
            }
            .workspace {
                padding: 20px 4% 40px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

@if(request()->routeIs('home', 'contact'))
    <!-- Practical 8: Reusable Blade Template System Layout -->
    @include('partials.navbar')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-1 w-full">
        @yield('content')
    </main>

    @include('partials.footer')
@else
    <!-- Top Navigation Header -->
    <header class="top-navbar">
        <a href="{{ route('dashboard') }}" class="brand-group">
            <div class="brand-icon">🎓</div>
            <div class="brand-info">
                <h1>Government Polytechnic, Jamnagar</h1>
                <p>Computer Engineering Department · Vibe Coding Lab</p>
            </div>
        </a>

        <div class="nav-badge-group">
            <span class="practical-pill">Practical 16: Mini Project</span>
            <div class="db-status-pill" title="Connected to MySQL practical12_db">
                <span class="db-dot"></span>
                <span>MySQL: practical12_db</span>
            </div>
        </div>
    </header>

    <!-- Sub Navigation Tabs (6-7 Pages/Modules) -->
    <nav class="sub-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span>📊</span> Dashboard
        </a>
        <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}">
            <span>👥</span> Student Directory
        </a>
        <a href="{{ route('students.create') }}" class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}">
            <span>➕</span> Add Student
        </a>
        <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.index') ? 'active' : '' }}">
            <span>🏛️</span> Departments &amp; Courses
        </a>
        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
            <span>ℹ️</span> About &amp; Architecture
        </a>
    </nav>

    <!-- Page Banner Header -->
    <section class="page-banner">
        <div class="banner-content">
            <div class="lab-badge">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                    <path d="M6 6h10"></path>
                    <path d="M6 10h10"></path>
                </svg>
                Practical 16 · Full-Stack CRUD Application
            </div>
            <h1>@yield('page_title', 'Student Management System')</h1>
            <p>@yield('page_subtitle', 'A complete web-based CRUD mini-project built with Laravel, MySQL, and Blade templates.')</p>
        </div>
    </section>

    <!-- Main Content Workspace -->
    <main class="workspace">
        <!-- Flash Success Notification -->
        @if(session('success'))
            <div class="alert alert-success">
                <div class="alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="alert-body">
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Flash Error Notification -->
        @if(session('error'))
            <div class="alert alert-danger">
                <div class="alert-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                </div>
                <div class="alert-body">
                    <strong>Error:</strong> {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>
            <strong>Practical 16 Mini Project</strong> · Web-based CRUD Application · 
            <span>Computer Engineering Department, Government Polytechnic Jamnagar</span>
        </p>
        <p style="font-size: 12px; color: var(--text-subtle); margin-top: 4px;">
            Laravel {{ app()->version() }} · PHP {{ PHP_VERSION }} · Database: practical12_db · Architecture: Model-View-Controller (MVC)
        </p>
    </footer>
@endif

    @stack('scripts')
</body>
</html>
