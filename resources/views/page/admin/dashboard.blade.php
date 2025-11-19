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
            Berikut ringkasan aktivitas platform Skillbridge hari ini
        </p>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card" style="border-left: 4px solid #3b82f6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #dbeafe; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div>
                    <div class="value">{{ \App\Models\Mahasiswa::count() ?? 1240 }}</div>
                    <div class="label">Total Mahasiswa</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #d1fae5; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-handshake"></i>
                </div>
                <div>
                    <div class="value">{{ \App\Models\Mitra::count() ?? 87 }}</div>
                    <div class="label">Total Mitra</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div>
                    <div class="value">{{ \App\Models\Loker::where('status', 'published')->count() ?? 156 }}</div>
                    <div class="label">Lowongan Aktif</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #ef4444;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="value">14</div>
                    <div class="label">Mitra Pending</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #8b5cf6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #ede9fe; color: #8b5cf6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="value">{{ \App\Models\Pelatihan::count() ?? 42 }}</div>
                    <div class="label">Total Pelatihan</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #06b6d4;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #cffafe; color: #06b6d4; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <div class="value">523</div>
                    <div class="label">Total Lamaran</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Grid -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 30px;">
        <!-- Chart Section -->
        <div class="content-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 class="card-title" style="margin: 0;">
                    <i class="fas fa-chart-line"></i> Statistik Lowongan
                </h3>
                <span style="color: var(--text-light); font-size: 14px;">30 Hari Terakhir</span>
            </div>
            <div style="height: 300px; background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 10px;">
                <i class="fas fa-chart-area" style="font-size: 48px; opacity: 0.3; color: var(--text-light);"></i>
                <p style="color: var(--text-light); font-size: 14px; margin: 0;">Grafik akan ditampilkan di sini</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="content-card">
            <h3 class="card-title" style="margin-bottom: 20px;">
                <i class="fas fa-bolt"></i> Quick Actions
            </h3>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <a href="#" class="btn-icon" style="display: flex; align-items: center; gap: 12px; padding: 15px; background: #f9fafb; border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='white'; this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f9fafb'; this.style.borderColor='var(--border)'; this.style.color='var(--text-dark)'; this.style.transform='translateX(0)';">
                    <i class="fas fa-user-plus" style="width: 20px; text-align: center;"></i>
                    <span>Tambah User Baru</span>
                </a>
                <a href="#" class="btn-icon" style="display: flex; align-items: center; gap: 12px; padding: 15px; background: #f9fafb; border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='white'; this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f9fafb'; this.style.borderColor='var(--border)'; this.style.color='var(--text-dark)'; this.style.transform='translateX(0)';">
                    <i class="fas fa-check-circle" style="width: 20px; text-align: center;"></i>
                    <span>Verifikasi Mitra</span>
                </a>
                <a href="#" class="btn-icon" style="display: flex; align-items: center; gap: 12px; padding: 15px; background: #f9fafb; border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='white'; this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f9fafb'; this.style.borderColor='var(--border)'; this.style.color='var(--text-dark)'; this.style.transform='translateX(0)';">
                    <i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i>
                    <span>Kelola Lowongan</span>
                </a>
                <a href="{{ route('admin.kelola.pelatihan') }}" class="btn-icon" style="display: flex; align-items: center; gap: 12px; padding: 15px; background: #f9fafb; border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='white'; this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f9fafb'; this.style.borderColor='var(--border)'; this.style.color='var(--text-dark)'; this.style.transform='translateX(0)';">
                    <i class="fas fa-graduation-cap" style="width: 20px; text-align: center;"></i>
                    <span>Kelola Pelatihan</span>
                </a>
                <a href="#" class="btn-icon" style="display: flex; align-items: center; gap: 12px; padding: 15px; background: #f9fafb; border-radius: 8px; text-decoration: none; color: var(--text-dark); font-weight: 500; transition: all 0.3s;" onmouseover="this.style.background='white'; this.style.borderColor='var(--primary)'; this.style.color='var(--primary)'; this.style.transform='translateX(5px)';" onmouseout="this.style.background='#f9fafb'; this.style.borderColor='var(--border)'; this.style.color='var(--text-dark)'; this.style.transform='translateX(0)';">
                    <i class="fas fa-cog" style="width: 20px; text-align: center;"></i>
                    <span>Pengaturan</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-history"></i> Aktivitas Terbaru
            </h3>
            <a href="#" style="color: var(--primary); font-size: 14px; text-decoration: none; font-weight: 600;">Lihat Semua</a>
        </div>

        <div>
            <div style="display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid var(--border); transition: background 0.2s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                <div style="width: 40px; height: 40px; background: #dbeafe; color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 3px; font-size: 14px;">User baru mendaftar sebagai Mahasiswa</div>
                    <div style="color: #9ca3af; font-size: 12px;">5 menit yang lalu</div>
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid var(--border); transition: background 0.2s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                <div style="width: 40px; height: 40px; background: #fef3c7; color: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 3px; font-size: 14px;">Lowongan baru dipublikasikan oleh PT Tech Indonesia</div>
                    <div style="color: #9ca3af; font-size: 12px;">15 menit yang lalu</div>
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid var(--border); transition: background 0.2s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                <div style="width: 40px; height: 40px; background: #d1fae5; color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 3px; font-size: 14px;">10 lamaran baru untuk posisi Web Developer</div>
                    <div style="color: #9ca3af; font-size: 12px;">1 jam yang lalu</div>
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 15px; border-bottom: 1px solid var(--border); transition: background 0.2s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                <div style="width: 40px; height: 40px; background: #dbeafe; color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-handshake"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 3px; font-size: 14px;">Mitra baru menunggu verifikasi: PT Digital Media</div>
                    <div style="color: #9ca3af; font-size: 12px;">2 jam yang lalu</div>
                </div>
            </div>

            <div style="display: flex; gap: 15px; padding: 15px; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb';" onmouseout="this.style.background='transparent';">
                <div style="width: 40px; height: 40px; background: #fef3c7; color: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 3px; font-size: 14px;">Pelatihan baru "Laravel for Beginners" dipublikasikan</div>
                    <div style="color: #9ca3af; font-size: 12px;">3 jam yang lalu</div>
                </div>
            </div>
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

    @media (max-width: 1024px) {
        div[style*="grid-template-columns: 2fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
