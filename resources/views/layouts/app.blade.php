<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LibraryMS — {{ config('app.name', 'Library') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { font-family: 'Inter', sans-serif; }

            body { background: #0f1117; color: #e2e8f0; }

            /* Sidebar */
            .sidebar {
                width: 260px;
                background: linear-gradient(180deg, #1a1d2e 0%, #13151f 100%);
                border-right: 1px solid rgba(255,255,255,0.06);
                min-height: 100vh;
                position: fixed;
                left: 0; top: 0; bottom: 0;
                display: flex;
                flex-direction: column;
                z-index: 50;
            }
            .sidebar-logo {
                padding: 28px 24px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
            }
            .sidebar-logo .logo-icon {
                width: 40px; height: 40px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                font-size: 20px; margin-bottom: 10px;
            }
            .sidebar-logo .logo-title {
                font-size: 18px; font-weight: 700;
                background: linear-gradient(135deg, #a5b4fc, #c4b5fd);
                -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            }
            .sidebar-logo .logo-sub {
                font-size: 11px; color: #64748b; font-weight: 500; letter-spacing: 0.05em;
            }
            .sidebar-nav { padding: 16px 12px; flex: 1; }
            .nav-section-label {
                font-size: 10px; font-weight: 600; letter-spacing: 0.1em;
                color: #475569; text-transform: uppercase; padding: 8px 12px 6px;
            }
            .nav-link {
                display: flex; align-items: center; gap: 10px;
                padding: 10px 12px; border-radius: 10px;
                color: #94a3b8; font-size: 14px; font-weight: 500;
                text-decoration: none; margin-bottom: 2px;
                transition: all 0.2s ease; position: relative; overflow: hidden;
            }
            .nav-link:hover { background: rgba(99,102,241,0.1); color: #c4b5fd; }
            .nav-link.active {
                background: linear-gradient(135deg, rgba(99,102,241,0.2), rgba(139,92,246,0.15));
                color: #a5b4fc;
                box-shadow: inset 0 0 0 1px rgba(99,102,241,0.3);
            }
            .nav-link .icon {
                width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
                font-size: 16px;
            }
            .sidebar-footer {
                padding: 16px 12px;
                border-top: 1px solid rgba(255,255,255,0.06);
            }
            .user-card {
                display: flex; align-items: center; gap: 10px;
                padding: 10px 12px; border-radius: 10px;
                background: rgba(255,255,255,0.04);
            }
            .user-avatar {
                width: 34px; height: 34px; border-radius: 50%;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                display: flex; align-items: center; justify-content: center;
                font-size: 13px; font-weight: 700; color: white; flex-shrink: 0;
            }
            .user-name { font-size: 13px; font-weight: 600; color: #e2e8f0; }
            .user-role { font-size: 11px; color: #64748b; }
            .logout-btn {
                display: flex; align-items: center; gap: 8px;
                width: 100%; padding: 8px 12px; margin-top: 8px;
                background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);
                color: #f87171; border-radius: 8px;
                font-size: 13px; font-weight: 500; cursor: pointer;
                transition: all 0.2s; text-align: left;
            }
            .logout-btn:hover { background: rgba(239,68,68,0.2); }

            /* Main Content */
            .main-content { margin-left: 260px; min-height: 100vh; }
            .page-header {
                padding: 28px 32px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                background: rgba(26,29,46,0.5);
                backdrop-filter: blur(10px);
                position: sticky; top: 0; z-index: 40;
            }
            .page-header h1 {
                font-size: 22px; font-weight: 700; color: #f1f5f9;
            }
            .page-header p { font-size: 13px; color: #64748b; margin-top: 2px; }
            .page-body { padding: 28px 32px; }

            /* Cards */
            .card {
                background: #1a1d2e;
                border: 1px solid rgba(255,255,255,0.06);
                border-radius: 16px;
                overflow: hidden;
            }
            .card-header {
                padding: 18px 24px;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                display: flex; align-items: center; justify-content: space-between;
            }
            .card-title { font-size: 15px; font-weight: 600; color: #f1f5f9; }
            .card-body { padding: 24px; }

            /* Stats Cards */
            .stat-card {
                background: #1a1d2e;
                border: 1px solid rgba(255,255,255,0.06);
                border-radius: 16px;
                padding: 22px;
                position: relative; overflow: hidden;
            }
            .stat-card::before {
                content: '';
                position: absolute; top: 0; left: 0; right: 0;
                height: 2px;
            }
            .stat-card.purple::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
            .stat-card.blue::before { background: linear-gradient(90deg, #3b82f6, #6366f1); }
            .stat-card.green::before { background: linear-gradient(90deg, #10b981, #059669); }
            .stat-card.red::before { background: linear-gradient(90deg, #ef4444, #dc2626); }
            .stat-number { font-size: 30px; font-weight: 800; color: #f1f5f9; }
            .stat-label { font-size: 12px; font-weight: 500; color: #64748b; margin-top: 4px; text-transform: uppercase; letter-spacing: 0.05em; }
            .stat-icon {
                width: 44px; height: 44px; border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                font-size: 20px; margin-bottom: 14px;
            }
            .stat-icon.purple { background: rgba(99,102,241,0.15); }
            .stat-icon.blue { background: rgba(59,130,246,0.15); }
            .stat-icon.green { background: rgba(16,185,129,0.15); }
            .stat-icon.red { background: rgba(239,68,68,0.15); }

            /* Tables */
            .data-table { width: 100%; border-collapse: collapse; }
            .data-table th {
                padding: 12px 16px; text-align: left;
                font-size: 11px; font-weight: 600; letter-spacing: 0.07em;
                text-transform: uppercase; color: #64748b;
                border-bottom: 1px solid rgba(255,255,255,0.06);
                background: rgba(0,0,0,0.1);
            }
            .data-table td {
                padding: 14px 16px; font-size: 14px; color: #cbd5e1;
                border-bottom: 1px solid rgba(255,255,255,0.04);
            }
            .data-table tr:last-child td { border-bottom: none; }
            .data-table tbody tr {
                transition: background 0.15s;
            }
            .data-table tbody tr:hover { background: rgba(255,255,255,0.02); }

            /* Buttons */
            .btn-primary {
                display: inline-flex; align-items: center; gap: 6px;
                padding: 9px 18px;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                color: white; border-radius: 9px;
                font-size: 13px; font-weight: 600;
                text-decoration: none; border: none; cursor: pointer;
                transition: all 0.2s; box-shadow: 0 4px 15px rgba(99,102,241,0.3);
            }
            .btn-primary:hover {
                transform: translateY(-1px);
                box-shadow: 0 6px 20px rgba(99,102,241,0.4);
            }
            .btn-secondary {
                display: inline-flex; align-items: center; gap: 6px;
                padding: 8px 16px;
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.1);
                color: #94a3b8; border-radius: 9px;
                font-size: 13px; font-weight: 500;
                text-decoration: none; cursor: pointer;
                transition: all 0.2s;
            }
            .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #e2e8f0; }
            .btn-danger {
                display: inline-flex; align-items: center; gap: 4px;
                padding: 6px 12px;
                background: rgba(239,68,68,0.1);
                border: 1px solid rgba(239,68,68,0.2);
                color: #f87171; border-radius: 7px;
                font-size: 12px; font-weight: 500;
                cursor: pointer; transition: all 0.2s;
            }
            .btn-danger:hover { background: rgba(239,68,68,0.2); }
            .btn-edit {
                display: inline-flex; align-items: center; gap: 4px;
                padding: 6px 12px;
                background: rgba(99,102,241,0.1);
                border: 1px solid rgba(99,102,241,0.2);
                color: #a5b4fc; border-radius: 7px;
                font-size: 12px; font-weight: 500;
                text-decoration: none; transition: all 0.2s;
            }
            .btn-edit:hover { background: rgba(99,102,241,0.2); }
            .btn-success {
                display: inline-flex; align-items: center; gap: 4px;
                padding: 6px 12px;
                background: rgba(16,185,129,0.1);
                border: 1px solid rgba(16,185,129,0.2);
                color: #34d399; border-radius: 7px;
                font-size: 12px; font-weight: 500;
                cursor: pointer; transition: all 0.2s;
            }
            .btn-success:hover { background: rgba(16,185,129,0.2); }

            /* Badges */
            .badge {
                display: inline-flex; align-items: center;
                padding: 3px 10px; border-radius: 20px;
                font-size: 11px; font-weight: 600; letter-spacing: 0.03em;
            }
            .badge-borrowed { background: rgba(59,130,246,0.15); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }
            .badge-returned { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
            .badge-overdue { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }
            .badge-paid { background: rgba(16,185,129,0.15); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
            .badge-unpaid { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.2); }

            /* Forms */
            .form-group { margin-bottom: 20px; }
            .form-label {
                display: block; font-size: 13px; font-weight: 500;
                color: #94a3b8; margin-bottom: 6px;
            }
            .form-input {
                width: 100%; padding: 10px 14px;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 10px; color: #e2e8f0; font-size: 14px;
                transition: all 0.2s; outline: none;
            }
            .form-input:focus {
                border-color: #6366f1;
                box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
                background: rgba(99,102,241,0.05);
            }
            .form-input::placeholder { color: #475569; }
            select.form-input option { background: #1a1d2e; }

            /* Alert */
            .alert-success {
                padding: 12px 16px; border-radius: 10px;
                background: rgba(16,185,129,0.1);
                border: 1px solid rgba(16,185,129,0.2);
                color: #34d399; font-size: 13px; margin-bottom: 20px;
                display: flex; align-items: center; gap: 8px;
            }
            .form-error { color: #f87171; font-size: 12px; margin-top: 4px; }

            /* Return form inline */
            .return-form { display: flex; align-items: center; gap: 6px; }
            .return-date-input {
                padding: 5px 10px; border-radius: 7px;
                background: rgba(255,255,255,0.05);
                border: 1px solid rgba(255,255,255,0.1);
                color: #e2e8f0; font-size: 12px; outline: none;
            }
            .return-date-input:focus { border-color: #10b981; }

            /* Empty state */
            .empty-state {
                text-align: center; padding: 48px 24px;
                color: #475569;
            }
            .empty-state .empty-icon { font-size: 48px; margin-bottom: 12px; }
            .empty-state p { font-size: 14px; }
        </style>
    </head>
    <body>
        <div style="display:flex;">
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-logo">
                    <div class="logo-icon">📚</div>
                    <div class="logo-title">LibraryMS</div>
                    <div class="logo-sub">MANAGEMENT SYSTEM</div>
                </div>

                <nav class="sidebar-nav">
                    <div class="nav-section-label">Main Menu</div>
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span class="icon">🏠</span> Dashboard
                    </a>
                    <a href="{{ route('books.index') }}"
                       class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                        <span class="icon">📖</span> Books
                    </a>
                    <a href="{{ route('members.index') }}"
                       class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">
                        <span class="icon">👥</span> Members
                    </a>
                    <a href="{{ route('borrowings.index') }}"
                       class="nav-link {{ request()->routeIs('borrowings.*') ? 'active' : '' }}">
                        <span class="icon">🔄</span> Borrowings
                    </a>
                    <a href="{{ route('penalties.index') }}"
                       class="nav-link {{ request()->routeIs('penalties.*') ? 'active' : '' }}">
                        <span class="icon">⚠️</span> Penalties
                    </a>
                </nav>

                <div class="sidebar-footer">
                    <div class="user-card">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <div>
                            <div class="user-name">{{ Auth::user()->name }}</div>
                            <div class="user-role">Administrator</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">
                            🚪 Sign Out
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="main-content" style="flex:1;">
                @isset($header)
                    <div class="page-header">
                        {{ $header }}
                    </div>
                @endisset

                <div class="page-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
