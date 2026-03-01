<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CycleCare Workshop')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink:      #1976d2;
            --pink-dark: #1565c0;
            --pink-light:#e3f2fd;
            --pink-mid:  #bbdefb;
            --sidebar-w: 240px;
            --text:      #2d2d2d;
            --muted:     #777;
            --border:    #e8e8e8;
            --bg:        #f0f4f8;
            --white:     #ffffff;
            --success:   #2e7d32;
            --danger:    #c62828;
            --warning:   #e65100;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: var(--sidebar-w);
            background: linear-gradient(180deg, #1565c0 0%, #0d47a1 100%);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .sidebar-brand svg { width: 34px; height: 34px; flex-shrink: 0; }

        .sidebar-brand span {
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.3px;
        }

        .sidebar-brand small {
            display: block;
            font-size: 0.7rem;
            font-weight: 400;
            color: rgba(255,255,255,0.7);
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            padding: 16px 0;
            flex: 1;
        }

        .nav-label {
            padding: 10px 20px 4px;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 20px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            border-left-color: #fff;
        }

        .sidebar-nav a svg { width: 18px; height: 18px; flex-shrink: 0; opacity: 0.9; }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-footer .user-name {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.75);
            margin-bottom: 8px;
        }

        .sidebar-footer form button {
            width: 100%;
            padding: 8px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            border-radius: 6px;
            font-size: 0.82rem;
            cursor: pointer;
            transition: background 0.15s;
        }

        .sidebar-footer form button:hover { background: rgba(255,255,255,0.25); }

        /* ── Main ── */
        .main-wrap {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 28px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar h1 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text);
        }

        .topbar-actions { display: flex; align-items: center; gap: 10px; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 7px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity 0.15s, transform 0.1s;
        }

        .btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-primary { background: var(--pink); color: #fff; }
        .btn-outline  { background: transparent; border: 1.5px solid var(--pink); color: var(--pink); }
        .btn-danger   { background: #fdecea; border: 1.5px solid #f5c6cb; color: var(--danger); }
        .btn-sm { padding: 5px 10px; font-size: 0.78rem; }

        .page-content { padding: 28px; flex: 1; }

        /* ── Alerts ── */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.875rem;
        }

        .alert-success { background: #e8f5e9; border: 1px solid #a5d6a7; color: var(--success); }
        .alert-danger  { background: #fdecea; border: 1px solid #f5c6cb; color: var(--danger); }

        /* ── Cards ── */
        .card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 1px 8px rgba(0,0,0,0.07);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 { font-size: 1rem; font-weight: 600; }
        .card-body { padding: 24px; }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.875rem;
        }

        thead th {
            background: #ebf2ff;
            padding: 11px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--pink-dark);
            border-bottom: 2px solid var(--pink-mid);
        }

        tbody td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #f5f8ff; }

        .td-actions { display: flex; gap: 6px; align-items: center; }

        /* ── Badges ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 600;
        }

        .badge-pending  { background: #fff3e0; color: #e65100; }
        .badge-progress { background: #e3f2fd; color: #1565c0; }
        .badge-done     { background: #e8f5e9; color: #2e7d32; }

        /* ── Forms ── */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-grid.cols-1 { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }

        label {
            font-size: 0.82rem;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="password"],
        select,
        textarea {
            padding: 10px 12px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--text);
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            width: 100%;
            font-family: inherit;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--pink);
            box-shadow: 0 0 0 3px rgba(25,118,210,0.15);
        }

        textarea { resize: vertical; min-height: 90px; }

        .error-text { color: var(--danger); font-size: 0.78rem; }

        /* ── Stats ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: 12px;
            padding: 22px 20px;
            box-shadow: 0 1px 8px rgba(0,0,0,0.07);
            border-left: 4px solid var(--pink);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .stat-card .label { font-size: 0.78rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 600; }
        .stat-card .value { font-size: 2rem; font-weight: 700; color: var(--pink-dark); line-height: 1; }
        .stat-card .sub   { font-size: 0.78rem; color: var(--muted); }

        /* ── Pagination ── */
        .pagination { display: flex; gap: 6px; margin-top: 20px; justify-content: center; flex-wrap: wrap; }
        .pagination a, .pagination span {
            padding: 6px 12px; border-radius: 6px; font-size: 0.82rem; text-decoration: none;
            border: 1px solid var(--border); color: var(--text);
        }
        .pagination a:hover { border-color: var(--pink); color: var(--pink); }
        .pagination .active span { background: var(--pink); color: #fff; border-color: var(--pink); }
        .pagination .disabled span { color: #ccc; }

        /* ── Detail row ── */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .detail-item { display: flex; flex-direction: column; gap: 3px; }
        .detail-item .dl { font-size: 0.78rem; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        .detail-item .dv { font-size: 0.9rem; color: var(--text); }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrap { margin-left: 0; }
            .form-grid { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <a class="sidebar-brand" href="{{ route('home') }}">
        <svg viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,0.15)"/><path d="M26 38s-11-7-11-14a7 7 0 0 1 11-5.74A7 7 0 0 1 37 24c0 7-11 14-11 14z" fill="#fff"/></svg>
        <div><span>CycleCare</span><small>Workshop System</small></div>
    </a>

    <nav class="sidebar-nav">
        <div class="nav-label">Main</div>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <a href="{{ route('search.index') }}" class="{{ request()->routeIs('search.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Search
        </a>

        <div class="nav-label" style="margin-top:8px">Modules</div>
        <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Customers
        </a>
        <a href="{{ route('bicycles.index') }}" class="{{ request()->routeIs('bicycles.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="18.5" cy="17.5" r="3.5"/><path d="M15 6a1 1 0 0 0-1-1h-1l-3 10"/><path d="m9 6 2 6h6"/><path d="M5.5 14 9 6"/></svg>
            Bicycles
        </a>
        <a href="{{ route('service-history.index') }}" class="{{ request()->routeIs('service-history.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            Service History
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-name">👤 {{ Auth::user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Sign Out</button>
        </form>
    </div>
</aside>

<!-- Main Wrapper -->
<div class="main-wrap">
    <div class="topbar">
        <h1>@yield('page-title', 'Dashboard')</h1>
        <div class="topbar-actions">@yield('topbar-actions')</div>
    </div>

    <div class="page-content">
        @if (session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">✗ {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
