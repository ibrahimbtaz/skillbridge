@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-tachometer-alt"></i> Dashboard Admin
    </h1>

    <!-- Welcome Card -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
        <h2 style="font-size: 28px; margin-bottom: 8px; font-weight: 700;">
            👋 Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!
        </h2>
        <p style="opacity: 0.9; font-size: 15px; margin: 0;">
            Berikut ringkasan aktivitas platform Skillbridge hari ini - {{ now()->format('d F Y') }}
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card" style="border-left: 4px solid #3b82f6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #dbeafe; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="value">{{ $totalUsers }}</div>
                    <div class="label">Total Pengguna</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #d1fae5; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <div class="value">{{ $totalMahasiswa }}</div>
                    <div class="label">Total Mahasiswa</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-building"></i>
                </div>
                <div>
                    <div class="value">{{ $totalMitra }}</div>
                    <div class="label">Total Mitra</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #8b5cf6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #ede9fe; color: #8b5cf6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div>
                    <div class="value">{{ $lokerAktif }}</div>
                    <div class="label">Lowongan Aktif</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #ef4444;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="value">{{ $lokerPending }}</div>
                    <div class="label">Loker Pending</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #06b6d4;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #cffafe; color: #06b6d4; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="value">{{ $totalPelatihan }}</div>
                    <div class="label">Total Pelatihan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-top: 30px;">
        <!-- Recent Users Section -->
        <div class="content-card" style="margin-top: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 class="card-title" style="margin: 0;">
                    <i class="fas fa-user-clock"></i> Pengguna Terbaru
                </h3>
                <a href="{{ route('admin.kelola.user') }}" style="color: var(--primary); font-size: 14px; text-decoration: none; font-weight: 600;">Lihat Semua</a>
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentUsers as $user)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    @php
                                        $initials = strtoupper(substr($user->name ?? 'U', 0, 2));
                                        $roleColors = [
                                            '1' => ['bg' => '#ede9fe', 'text' => '#8b5cf6'],
                                            '2' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                            '3' => ['bg' => '#dbeafe', 'text' => '#2563eb'],
                                        ];
                                        $color = $roleColors[$user->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                                    @endphp
                                    <div style="width: 35px; height: 35px; background: {{ $color['bg'] }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $color['text'] }}; font-size: 12px;">
                                        {{ $initials }}
                                    </div>
                                    <span style="font-weight: 600;">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td style="font-size: 13px;">{{ $user->email }}</td>
                            <td>
                                @php
                                    $roleLabels = [
                                        '1' => ['icon' => 'fa-user-shield', 'label' => 'Admin', 'bg' => '#ede9fe', 'text' => '#8b5cf6'],
                                        '2' => ['icon' => 'fa-building', 'label' => 'Mitra', 'bg' => '#fef3c7', 'text' => '#92400e'],
                                        '3' => ['icon' => 'fa-user-graduate', 'label' => 'Mahasiswa', 'bg' => '#dbeafe', 'text' => '#2563eb'],
                                    ];
                                    $role = $roleLabels[$user->role] ?? ['icon' => 'fa-user', 'label' => 'User', 'bg' => '#f3f4f6', 'text' => '#374151'];
                                @endphp
                                <span style="background: {{ $role['bg'] }}; color: {{ $role['text'] }}; padding: 3px 8px; border-radius: 4px; font-size: 11px; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="fas {{ $role['icon'] }}"></i> {{ $role['label'] }}
                                </span>
                            </td>
                            <td style="font-size: 12px; color: var(--text-light);">{{ $user->created_at?->diffForHumans() ?? '' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-light);">Belum ada pengguna</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="content-card" style="margin-top: 0;">
            <h3 class="card-title" style="margin-bottom: 20px;">
                <i class="fas fa-bolt"></i> Quick Actions
            </h3>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="{{ route('admin.audit.loker') }}" class="quick-action-link">
                    <i class="fas fa-briefcase"></i>
                    <span>Audit Lowongan</span>
                    @if($lokerPending > 0)
                    <span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: auto;">{{ $lokerPending }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.audit.pelatihan') }}" class="quick-action-link">
                    <i class="fas fa-book"></i>
                    <span>Audit Pelatihan</span>
                    @if($pelatihanPending > 0)
                    <span style="background: #ef4444; color: white; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: auto;">{{ $pelatihanPending }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.kelola.pelatihan') }}" class="quick-action-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Kelola Pelatihan</span>
                </a>
                <a href="{{ route('admin.backup.index') }}" class="quick-action-link">
                    <i class="fas fa-database"></i>
                    <span>Backup Data</span>
                </a>
            </div>

            <!-- Summary Box -->
            <div style="margin-top: 25px; padding: 20px; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 10px; border: 1px solid #bae6fd;">
                <h4 style="margin: 0 0 15px 0; font-size: 14px; color: #0369a1;">
                    <i class="fas fa-chart-pie"></i> Ringkasan
                </h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <div style="font-size: 24px; font-weight: 700; color: #0369a1;">{{ $totalLamaran }}</div>
                        <div style="font-size: 12px; color: #0284c7;">Total Lamaran</div>
                    </div>
                    <div>
                        <div style="font-size: 24px; font-weight: 700; color: #0369a1;">{{ $totalLoker }}</div>
                        <div style="font-size: 12px; color: #0284c7;">Total Lowongan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Lokers -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-briefcase"></i> Lowongan Terbaru
            </h3>
            <a href="{{ route('admin.audit.loker') }}" style="color: var(--primary); font-size: 14px; text-decoration: none; font-weight: 600;">Lihat Semua</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Perusahaan</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Diposting</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentLokers as $loker)
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @php
                                    $initials = strtoupper(substr($loker->mitra->nama_mitra ?? 'NA', 0, 2));
                                    $colors = ['#dbeafe', '#dcfce7', '#fef3c7', '#fee2e2', '#e0e7ff'];
                                    $textColors = ['#2563eb', '#16a34a', '#92400e', '#dc2626', '#4338ca'];
                                    $colorIndex = $loker->id % count($colors);
                                @endphp
                                <div style="width: 35px; height: 35px; background: {{ $colors[$colorIndex] }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $textColors[$colorIndex] }}; font-size: 12px;">
                                    {{ $initials }}
                                </div>
                                <span style="font-weight: 600;">{{ $loker->mitra->nama_mitra ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td>{{ $loker->title }}</td>
                        <td>
                            @php
                                $statusStyles = [
                                    'pending' => ['bg' => '#fef3c7', 'color' => '#92400e', 'label' => 'Pending'],
                                    'approved' => ['bg' => '#dcfce7', 'color' => '#16a34a', 'label' => 'Approved'],
                                    'rejected' => ['bg' => '#fee2e2', 'color' => '#dc2626', 'label' => 'Rejected'],
                                ];
                                $status = $statusStyles[$loker->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'label' => ucfirst($loker->status)];
                            @endphp
                            <span style="background: {{ $status['bg'] }}; color: {{ $status['color'] }}; padding: 3px 8px; border-radius: 4px; font-size: 11px;">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td style="font-size: 12px; color: var(--text-light);">{{ $loker->created_at?->diffForHumans() ?? '' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--text-light);">Belum ada lowongan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .stat-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .quick-action-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        background: #f9fafb;
        border-radius: 8px;
        text-decoration: none;
        color: var(--text-dark);
        font-weight: 500;
        transition: all 0.3s;
        border: 1px solid transparent;
    }

    .quick-action-link:hover {
        background: white;
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(5px);
    }

    .quick-action-link i {
        width: 20px;
        text-align: center;
    }

    @media (max-width: 1024px) {
        div[style*="grid-template-columns: 2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
