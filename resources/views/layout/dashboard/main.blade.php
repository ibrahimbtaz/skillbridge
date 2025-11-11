<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mitra - Skill Bridge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5A67D8; --primary-dark: #4C51BF;
            --secondary: #4A5568; --background: #F7FAFC;
            --card-bg: #FFFFFF; --border: #E2E8F0;
            --text-dark: #1f2937; --text-light: #6b7280;
            --green: #10b981; --red: #E53E3E;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: var(--background);
        }
        .mitra-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 250px;
            background: var(--secondary);
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            padding: 24px;
            text-align: center;
            background: #3a4454;
        }
        .company-logo-sidebar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 10px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary);
            font-size: 24px;
        }
        .sidebar-header h2 {
            font-size: 16px;
            font-weight: 600;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            color: #cbd5e0;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        .nav-link:hover {
            background: #404a5a;
            color: white;
        }
        .nav-link.active {
            background: var(--primary);
            color: white;
            border-left: 4px solid #a3bffa;
            padding-left: 20px;
        }
        .nav-link i { width: 20px; text-align: center; }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Topbar */
        .topbar {
            background: var(--card-bg);
            padding: 16px 30px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary { background: var(--primary); color: white; }
        .user-profile {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Page Content */
        .content-wrapper {
            padding: 30px;
        }
        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 24px;
        }

        /* Stat Cards */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 24px;
        }
        .stat-card {
            background: var(--card-bg);
            border-radius: 10px;
            padding: 24px;
            border: 1px solid var(--border);
        }
        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }
        .stat-card .label {
            font-size: 15px;
            color: var(--text-light);
        }

        /* Tabel */
        .content-card {
            background: var(--card-bg);
            border-radius: 10px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-top: 30px;
            padding: 24px;
        }
        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
        }
        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
        }
        .table-wrapper { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 14px;
        }
        th {
            background: #f9fafb;
            font-weight: 600;
            color: var(--text-light);
        }
        td { color: var(--secondary); }
        .action-buttons { display: flex; gap: 10px; }
        .btn-icon {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid var(--border);
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            background: #fff;
            color: var(--text-light);
        }
        .btn-icon.view { color: var(--green); border-color: var(--green); }
    </style>
</head>
<body>
    <div class="mitra-wrapper">
        <nav class="sidebar">
             <div class="sidebar-header">
                <h2>
                    @if(auth()->user()->role == 1)
                        Admin Panel
                    @elseif(auth()->user()->role == 2)
                        {{ $mitra->nama_mitra ?? 'Mitra Panel' }}
                    @else
                        User Panel
                    @endif
                </h2>
            </div>
                <ul class="sidebar-nav">
                     <li>
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    @auth
                        @if (auth()->user()->role == 1)
                            <li><a href="{{ route('admin.user.index') }}" class="nav-link"><i class="fas fa-users"></i> Manajemen User</a></li>
                            <li><a href="{{ route('admin.pelatihan.index') }}" class="nav-link"><i class="fas fa-book"></i> Manajemen Pelatihan</a></li>
                            <li><a href="{{ route('admin.mitra.verify') }}" class="nav-link"><i class="fas fa-check-circle"></i> Verifikasi Mitra</a></li>
                        @endif

                        @if (auth()->user()->role == 2)
                            <li><a href="{{ route('mitra.loker.kelola') }}" class="nav-link {{ request()->routeIs('mitra.loker.kelola') ? 'active' : '' }}"><i class="fas fa-briefcase"></i> Kelola Lowongan</a></li>
                        @endif
                    @endauth
                </ul>
        </nav>

        <main class="main-content">
            <header class="topbar">
                @if(auth()->user()->role == 2)
                    <a href="{{ route('mitra.show') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i> Balik Ke profile
                    </a>
                @endif

                <div class="user-profile" style="margin-left: 20px;">
                    Halo,
                    @auth
                        @if (auth()->user()->role == 2)
                            {{ auth()->user()->name }}
                        @endif
                        @if (auth()->user()->role == 1)
                            {{ auth()->user()->name }}
                        @endif
                    @endauth
                    <i class="fas fa-user" style="margin-left: 8px;"></i>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>
