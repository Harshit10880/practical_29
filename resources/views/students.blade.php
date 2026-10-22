@php $errors = $errors ?? new \Illuminate\Support\ViewErrorBag; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practical 15 - Retrieve & Display Database Records in Blade | GPC Jamnagar</title>

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
            padding: 16px 5%;
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
            gap: 14px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
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
            font-size: 17px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand-info p {
            font-size: 12px;
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
            padding: 5px 14px;
            border-radius: var(--radius-full);
            font-size: 12px;
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
            padding: 5px 12px;
            border-radius: var(--radius-full);
            font-size: 12px;
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

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4338ca 100%);
            color: white;
            padding: 44px 5% 52px;
            position: relative;
            overflow: hidden;
        }

        .hero-banner::after {
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

        .hero-content {
            max-width: 1300px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .lab-subtitle {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #a5b4fc;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-content h2 {
            font-size: clamp(26px, 3.2vw, 36px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.03em;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .hero-content p {
            font-size: 15px;
            color: #e0e7ff;
            max-width: 760px;
            line-height: 1.6;
        }

        /* Stats Row */
        .stats-grid {
            max-width: 1300px;
            margin: -26px auto 30px;
            padding: 0 5%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 16px 20px;
            box-shadow: var(--shadow-md);
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-icon.indigo { background: #e0e7ff; color: #4338ca; }
        .stat-icon.emerald { background: #d1fae5; color: #047857; }
        .stat-icon.purple { background: #f3e8ff; color: #6b21a8; }
        .stat-icon.amber { background: #fef3c7; color: #b45309; }

        .stat-details h3 {
            font-size: 19px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .stat-details p {
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        /* Main Workspace Container */
        .main-container {
            max-width: 1300px;
            width: 100%;
            margin: 0 auto;
            padding: 0 5% 48px;
            display: grid;
            grid-template-columns: 480px 1fr;
            gap: 28px;
            align-items: start;
            flex: 1;
        }

        /* Card Styles */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px 18px;
            border-bottom: 1px solid var(--border-color);
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .card-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.02em;
        }

        .card-header p {
            font-size: 13px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .card-body {
            padding: 24px;
        }

        /* Alerts */
        .alert {
            padding: 14px 18px;
            border-radius: var(--radius-md);
            margin-bottom: 20px;
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

        .alert-body strong {
            display: block;
            margin-bottom: 2px;
            font-weight: 700;
        }

        /* Search & Filter Bar */
        .filter-bar {
            padding: 14px 20px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            min-width: 200px;
        }

        .search-input {
            width: 100%;
            padding: 9px 12px 9px 36px;
            font-family: var(--font-main);
            font-size: 13px;
            color: var(--text-main);
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            outline: none;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
        }

        .search-icon {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-subtle);
            pointer-events: none;
        }

        .select-filter {
            padding: 9px 28px 9px 12px;
            font-family: var(--font-main);
            font-size: 13px;
            color: var(--text-main);
            background: #ffffff;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            outline: none;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 14px;
        }

        .btn-filter {
            padding: 9px 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-filter:hover {
            background: var(--primary-hover);
        }

        .btn-reset {
            padding: 9px 14px;
            background: transparent;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.15s ease;
        }

        .btn-reset:hover {
            background: #f1f5f9;
            color: var(--text-main);
        }

        /* Form Grid */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }

        .form-label .required {
            color: var(--danger);
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-subtle);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            width: 100%;
            padding: 11px 14px 11px 40px;
            font-family: var(--font-main);
            font-size: 13.5px;
            color: var(--text-main);
            background-color: #f8fafc;
            border: 1.5px solid var(--border-color);
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
            outline: none;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            padding-right: 36px;
            cursor: pointer;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
            background-color: #fffafb;
        }

        .input-helper {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .error-message {
            font-size: 11.5px;
            color: var(--danger);
            margin-top: 5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Section Separator */
        .form-divider {
            margin: 6px 0 14px;
            padding-top: 10px;
            border-top: 1px dashed var(--border-color);
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Form Action Buttons */
        .form-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px 22px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border: none;
            border-radius: var(--radius-sm);
            font-family: var(--font-main);
            font-size: 14px;
            font-weight: 700;
            letter-spacing: -0.01em;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
            filter: brightness(1.05);
        }

        .btn-secondary-row {
            display: flex;
            gap: 10px;
        }

        .btn-outline {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 14px;
            background: #ffffff;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .btn-outline:hover {
            background: #f1f5f9;
            color: var(--text-main);
            border-color: #cbd5e1;
        }

        /* Table Section */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .records-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }

        .records-table th {
            background: #f8fafc;
            color: var(--text-muted);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 13px 16px;
            border-bottom: 1px solid var(--border-color);
            white-space: nowrap;
        }

        .records-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 13.5px;
            color: var(--text-main);
            vertical-align: middle;
        }

        .records-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .records-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .records-table tbody tr:last-child td {
            border-bottom: none;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
            color: #4338ca;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
            text-transform: uppercase;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .student-name-bold {
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.3;
        }

        .enrollment-subtext {
            font-family: var(--font-mono);
            font-size: 11.5px;
            color: #6366f1;
            font-weight: 600;
        }

        .badge-academic {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            border-radius: var(--radius-sm);
            font-size: 11.5px;
            font-weight: 600;
            margin-right: 4px;
            margin-top: 3px;
        }

        .badge-semester {
            background: #ede9fe;
            color: #6b21a8;
            border: 1px solid #ddd6fe;
        }

        .badge-subject {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .college-title {
            font-size: 12.5px;
            color: #334155;
            font-weight: 600;
        }

        .id-badge {
            font-family: var(--font-mono);
            font-size: 12px;
            font-weight: 600;
            padding: 3px 8px;
            background: #f1f5f9;
            color: #475569;
            border-radius: var(--radius-sm);
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .time-text {
            font-size: 12px;
            color: var(--text-subtle);
            font-family: var(--font-mono);
        }

        .btn-delete {
            background: transparent;
            border: 1px solid #fee2e2;
            color: #ef4444;
            padding: 6px 10px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: #ffffff;
            border-color: #ef4444;
        }

        /* Empty State */
        .empty-state {
            padding: 48px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 64px;
            height: 64px;
            background: #f1f5f9;
            color: #94a3b8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
        }

        .empty-state h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .empty-state p {
            font-size: 13.5px;
            color: var(--text-muted);
            max-width: 360px;
            margin: 0 auto 18px;
            line-height: 1.5;
        }

        /* Technical Info Box */
        .info-accordion {
            margin-top: 22px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            background: #f8fafc;
            padding: 16px 20px;
        }

        .info-accordion-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            user-select: none;
        }

        .code-pill {
            font-family: var(--font-mono);
            background: #e2e8f0;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            color: #0f172a;
        }

        /* Footer */
        footer {
            margin-top: auto;
            background: #ffffff;
            border-top: 1px solid var(--border-color);
            padding: 24px 5%;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }

        footer strong {
            color: var(--text-main);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .main-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .top-navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .nav-badge-group {
                width: 100%;
                justify-content: space-between;
            }
            .hero-banner {
                padding: 32px 5% 42px;
            }
            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .card-body {
                padding: 18px;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <div class="brand-group">
            <div class="brand-icon">✦</div>
            <div class="brand-info">
                <h1>Government Polytechnic, Jamnagar</h1>
                <p>Computer Engineering Department · Vibe Coding Lab</p>
            </div>
        </div>

        <div class="nav-badge-group">
            <span class="practical-pill">Practical 15</span>
            <div class="db-status-pill" title="Connected to practical12_db MySQL Database">
                <span class="db-dot"></span>
                <span>MySQL: practical12_db</span>
            </div>
        </div>
    </header>

    <!-- Hero Header -->
    <section class="hero-banner">
        <div class="hero-content">
            <div class="lab-subtitle">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                    <path d="M6 6h10"></path>
                    <path d="M6 10h10"></path>
                </svg>
                Lab Manual Experiment #15
            </div>
            <h2>Retrieve & Display Database Records in Blade Views</h2>
            <p>
                Fetch student records from the MySQL database (<code style="color: #c7d2fe; font-family: var(--font-mono);">practical12_db</code>) using Laravel Eloquent ORM and render them dynamically in Blade templates using directives like <code style="color: #fed7aa; font-family: var(--font-mono);">@@forelse</code>, <code style="color: #fed7aa; font-family: var(--font-mono);">@@if</code>, and escaped expressions.
            </p>
        </div>
    </section>

    <!-- Quick Stats Cards with Dynamic Blade Values -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon indigo">👥</div>
            <div class="stat-details">
                <h3>{{ $students->count() }}</h3>
                <p>Retrieved Records</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon emerald">🗄️</div>
            <div class="stat-details">
                <h3 style="font-size: 16px; font-family: var(--font-mono);">MySQL / students</h3>
                <p>Data Source</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">🎯</div>
            <div class="stat-details">
                <h3 style="font-size: 16px; font-family: var(--font-mono);">Blade &amp; Directives</h3>
                <p>Template Directives</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber">⚡</div>
            <div class="stat-details">
                <h3 style="font-size: 16px; font-family: var(--font-mono);">Student::latest()</h3>
                <p>Eloquent ORM Query</p>
            </div>
        </div>
    </div>

    <!-- Main Workspace -->
    <main class="main-container">

        <!-- Left Column: Data Entry Form (Inserts into MySQL) -->
        <section class="card">
            <div class="card-header">
                <div>
                    <div class="card-header-title">
                        <div class="card-header-icon">✍️</div>
                        <h2>Insert New Student Record</h2>
                    </div>
                    <p>Store student record in MySQL database</p>
                </div>
            </div>

            <div class="card-body">

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success">
                        <div class="alert-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                        </div>
                        <div class="alert-body">
                            <strong>Success!</strong>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                <!-- Validation Error Alert -->
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
                            <strong>Please correct the following errors:</strong>
                            <ul style="margin-top: 4px; padding-left: 18px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Form Element (Native Laravel POST) -->
                <form action="{{ route('students.store') }}" method="POST" id="studentForm" novalidate>
                    @csrf

                    <!-- Row 1: Student Full Name & Enrollment No -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Student Name <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="e.g. Aarav Patel" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus
                                >
                            </div>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="enrollment_no" class="form-label">
                                Enrollment / Std ID
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="3" rx="2"></rect>
                                        <path d="M7 7h10"></path>
                                        <path d="M7 12h10"></path>
                                        <path d="M7 17h6"></path>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    id="enrollment_no" 
                                    name="enrollment_no" 
                                    class="form-control @error('enrollment_no') is-invalid @enderror" 
                                    placeholder="e.g. 236250307001" 
                                    value="{{ old('enrollment_no') }}"
                                >
                            </div>
                            @error('enrollment_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-divider">
                        <span>🏫 College & Academic Details</span>
                    </div>

                    <!-- College / Institute -->
                    <div class="form-group">
                        <label for="college" class="form-label">
                            College / Institute
                        </label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18"></path>
                                    <path d="M5 21V7l8-4 8 4v14"></path>
                                    <path d="M9 10a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2"></path>
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                id="college" 
                                name="college" 
                                class="form-control @error('college') is-invalid @enderror" 
                                placeholder="e.g. Government Polytechnic, Jamnagar" 
                                value="{{ old('college', 'Government Polytechnic, Jamnagar') }}"
                            >
                        </div>
                        @error('college')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Row 2: Semester & Subject -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="semester" class="form-label">
                                Semester
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                                    </svg>
                                </span>
                                <select 
                                    id="semester" 
                                    name="semester" 
                                    class="form-control @error('semester') is-invalid @enderror"
                                >
                                    <option value="">Select Semester</option>
                                    <option value="Semester 1" {{ old('semester') == 'Semester 1' ? 'selected' : '' }}>Semester 1</option>
                                    <option value="Semester 2" {{ old('semester') == 'Semester 2' ? 'selected' : '' }}>Semester 2</option>
                                    <option value="Semester 3" {{ old('semester') == 'Semester 3' ? 'selected' : '' }}>Semester 3</option>
                                    <option value="Semester 4" {{ old('semester') == 'Semester 4' ? 'selected' : '' }}>Semester 4</option>
                                    <option value="Semester 5" {{ old('semester') == 'Semester 5' ? 'selected' : '' }}>Semester 5</option>
                                    <option value="Semester 6" {{ old('semester', 'Semester 6') == 'Semester 6' ? 'selected' : '' }}>Semester 6</option>
                                </select>
                            </div>
                            @error('semester')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">
                                Subject / Branch
                            </label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"></path>
                                        <path d="M6 6h10"></path>
                                        <path d="M6 10h10"></path>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    id="subject" 
                                    name="subject" 
                                    class="form-control @error('subject') is-invalid @enderror" 
                                    placeholder="e.g. Vibe Coding / Web Dev" 
                                    value="{{ old('subject', 'Vibe Coding') }}"
                                >
                            </div>
                            @error('subject')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-divider">
                        <span>📞 Contact Information</span>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            Email Address <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </span>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="e.g. aarav.patel@gpcjamnagar.edu.in" 
                                value="{{ old('email') }}" 
                                required
                            >
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @else
                            <div class="input-helper">Must be unique in practical12_db</div>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            Phone Number <span style="font-weight: 400; color: var(--text-muted);">(Optional)</span>
                        </label>
                        <div class="input-wrapper">
                            <span class="input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </span>
                            <input 
                                type="text" 
                                id="phone" 
                                name="phone" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                placeholder="e.g. +91 98765 43210" 
                                value="{{ old('phone') }}" 
                                maxlength="15"
                            >
                        </div>
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Save to MySQL Database
                        </button>

                        <div class="btn-secondary-row">
                            <button type="button" class="btn-outline" onclick="fillSampleData()" title="Quickly populate with test data">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"/>
                                </svg>
                                Quick Fill Demo
                            </button>
                            <button type="button" class="btn-outline" onclick="clearForm()">
                                ✕ Clear
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Technical Details Accordion -->
                <div class="info-accordion">
                    <div class="info-accordion-title">
                        <span>🔧 Practical 15 Implementation Summary</span>
                    </div>
                    <div style="font-size: 12px; color: #64748b; margin-top: 8px; line-height: 1.6;">
                        • Retrieval: <span class="code-pill">Student::latest()->get()</span><br>
                        • Directives: <span class="code-pill">@@forelse, @@empty, @@if</span><br>
                        • Database: <span class="code-pill">MySQL: practical12_db.students</span><br>
                        • View: <span class="code-pill">resources/views/students.blade.php</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- Right Column: Database Records Display (Powered by Blade Templates) -->
        <section class="card">
            <div class="card-header">
                <div>
                    <div class="card-header-title">
                        <div class="card-header-icon" style="background: #ecfdf5; color: #059669;">📋</div>
                        <h2>MySQL Database Records</h2>
                    </div>
                    <p>Retrieved from <code style="font-family: var(--font-mono); color: #4338ca;">practical12_db.students</code> via Eloquent &amp; Blade</p>
                </div>

                <div style="font-size: 13px; font-weight: 700; color: #4338ca; background: #e0e7ff; padding: 4px 10px; border-radius: 6px;">
                    {{ $students->count() }} Records Found
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <form action="{{ route('students.index') }}" method="GET" class="filter-bar">
                <div class="search-box">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input" 
                        placeholder="Search name, roll no, email, subject..." 
                        value="{{ request('search') }}"
                    >
                </div>

                <select name="semester" class="select-filter">
                    <option value="">All Semesters</option>
                    @foreach(['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6'] as $sem)
                        <option value="{{ $sem }}" {{ request('semester') == $sem ? 'selected' : '' }}>
                            {{ $sem }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-filter">Search</button>

                @if(request('search') || request('semester'))
                    <a href="{{ route('students.index') }}" class="btn-reset" title="Clear search and filters">
                        ✕ Reset
                    </a>
                @endif
            </form>

            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="records-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th>Student Details</th>
                                <th>College &amp; Branch</th>
                                <th>Semester &amp; Subject</th>
                                <th>Contact</th>
                                <th style="text-align: right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Practical 15 Core: Blade forelse directive to loop & display database records --}}
                            @forelse($students as $student)
                                <tr>
                                    <td>
                                        <span class="id-badge">#{{ $student->id }}</span>
                                    </td>
                                    <td>
                                        <div class="student-cell">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="student-name-bold">{{ $student->name }}</div>
                                                @if($student->enrollment_no)
                                                    <div class="enrollment-subtext">Roll/ID: {{ $student->enrollment_no }}</div>
                                                @else
                                                    <div style="font-size: 11px; color: var(--text-subtle);">No ID specified</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="college-title">
                                            {{ $student->college ?: 'GPC Jamnagar' }}
                                        </div>
                                        <div class="time-text">
                                            {{ $student->created_at ? $student->created_at->format('d M Y, h:i A') : 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if($student->semester)
                                                <span class="badge-academic badge-semester">
                                                    🎓 {{ $student->semester }}
                                                </span>
                                            @endif
                                            @if($student->subject)
                                                <span class="badge-academic badge-subject">
                                                    📖 {{ $student->subject }}
                                                </span>
                                            @endif
                                            @if(!$student->semester && !$student->subject)
                                                <span style="color: var(--text-subtle); font-size: 12px; font-style: italic;">General</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-size: 13px; color: var(--text-main); font-weight: 500;">
                                            {{ $student->email }}
                                        </div>
                                        @if($student->phone)
                                            <div style="font-family: var(--font-mono); font-size: 12px; color: #475569;">
                                                📞 {{ $student->phone }}
                                            </div>
                                        @endif
                                    </td>
                                    <td style="text-align: right;">
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete student #{{ $student->id }} ({{ $student->name }}) from MySQL?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Delete record from MySQL database">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 0;">
                                        <div class="empty-state">
                                            <div class="empty-icon">📂</div>
                                            <h3>No Student Records Found</h3>
                                            @if(request('search') || request('semester'))
                                                <p>No records matched your search criteria "{{ request('search') }}".</p>
                                                <a href="{{ route('students.index') }}" class="btn-outline" style="display: inline-flex; margin: 0 auto;">
                                                    Clear Filters
                                                </a>
                                            @else
                                                <p>The MySQL database table is currently empty. Use the data entry form on the left to add a record!</p>
                                                <button type="button" class="btn-outline" onclick="fillSampleData()" style="margin: 0 auto;">
                                                    ⚡ Fill Sample Student Data
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer>
        <p>
            <strong>Practical 15</strong> · Retrieve and Display Database Records in Laravel Blade Views · 
            <span>Computer Engineering Department, Government Polytechnic Jamnagar</span>
        </p>
        <p style="font-size: 12px; color: var(--text-subtle); margin-top: 4px;">
            Laravel {{ app()->version() }} · PHP {{ PHP_VERSION }} · Database: practical12_db · Directives: @@forelse, @@if, @@empty
        </p>
    </footer>

    <!-- JavaScript Helpers for Quick Testing -->
    <script>
        const sampleStudents = [
            { 
                name: 'Aarav Patel', 
                enrollment_no: '236250307001', 
                college: 'Government Polytechnic, Jamnagar', 
                semester: 'Semester 6', 
                subject: 'Vibe Coding (Laravel)', 
                email: 'aarav.patel@gpcjamnagar.edu.in', 
                phone: '+91 98765 43210' 
            },
            { 
                name: 'Kavya Sharma', 
                enrollment_no: '236250307015', 
                college: 'Government Polytechnic, Jamnagar', 
                semester: 'Semester 6', 
                subject: 'Web Technologies & PHP', 
                email: 'kavya.sharma@gpcjamnagar.edu.in', 
                phone: '+91 98250 12345' 
            },
            { 
                name: 'Dev Joshi', 
                enrollment_no: '236250307028', 
                college: 'Government Polytechnic, Jamnagar', 
                semester: 'Semester 4', 
                subject: 'Database Management Systems', 
                email: 'dev.joshi@gpcjamnagar.edu.in', 
                phone: '+91 94280 67890' 
            },
            { 
                name: 'Pooja Vaghela', 
                enrollment_no: '236250307042', 
                college: 'Government Polytechnic, Jamnagar', 
                semester: 'Semester 6', 
                subject: 'Advanced Software Engineering', 
                email: 'pooja.vaghela@gpcjamnagar.edu.in', 
                phone: '+91 97240 33445' 
            }
        ];

        let sampleIndex = 0;

        function fillSampleData() {
            const sample = sampleStudents[sampleIndex % sampleStudents.length];
            const randomSuffix = Math.floor(Math.random() * 900 + 100);
            const emailParts = sample.email.split('@');
            const uniqueEmail = emailParts[0] + randomSuffix + '@' + emailParts[1];

            document.getElementById('name').value = sample.name;
            document.getElementById('enrollment_no').value = sample.enrollment_no;
            document.getElementById('college').value = sample.college;
            document.getElementById('semester').value = sample.semester;
            document.getElementById('subject').value = sample.subject;
            document.getElementById('email').value = uniqueEmail;
            document.getElementById('phone').value = sample.phone;
            sampleIndex++;

            document.getElementById('name').focus();
        }

        function clearForm() {
            document.getElementById('name').value = '';
            document.getElementById('enrollment_no').value = '';
            document.getElementById('college').value = 'Government Polytechnic, Jamnagar';
            document.getElementById('semester').value = 'Semester 6';
            document.getElementById('subject').value = 'Vibe Coding';
            document.getElementById('email').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('name').focus();
        }
    </script>
</body>
</html>
