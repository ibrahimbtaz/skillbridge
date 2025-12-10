@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-database"></i> Backup & Restore Database
    </h1>

    <!-- Alert Messages -->
    @if(session('success'))
        <div style="background: linear-gradient(to right, #dcfce7, #d1fae5); border-left: 4px solid #10b981; color: #065f46; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-check-circle" style="font-size: 20px; color: #10b981;"></i>
            <div>
                <p style="font-weight: 600; margin: 0;">Sukses!</p>
                <p style="font-size: 14px; margin: 0; margin-top: 2px;">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div style="background: linear-gradient(to right, #fee2e2, #fecaca); border-left: 4px solid var(--red); color: #991b1b; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-exclamation-circle" style="font-size: 20px; color: var(--red);"></i>
            <div>
                <p style="font-weight: 600; margin: 0;">Error!</p>
                <p style="font-size: 14px; margin: 0; margin-top: 2px;">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div style="background: linear-gradient(to right, #fef3c7, #fde68a); border-left: 4px solid #f59e0b; color: #92400e; padding: 16px 20px; border-radius: 8px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <i class="fas fa-exclamation-triangle" style="font-size: 20px; color: #f59e0b;"></i>
            <div>
                <p style="font-weight: 600; margin: 0;">Peringatan!</p>
                <p style="font-size: 14px; margin: 0; margin-top: 2px;">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    <!-- Loading Overlay -->
    <div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background: white; padding: 40px; border-radius: 16px; text-align: center; max-width: 400px;">
            <div style="width: 80px; height: 80px; margin: 0 auto 20px; border: 6px solid #f3f4f6; border-top: 6px solid var(--primary); border-radius: 50%; animation: spin 1s linear infinite;"></div>
            <h3 style="font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px;">Sedang Membuat Backup...</h3>
            <p style="color: var(--text-light); font-size: 14px; margin-bottom: 0;">Proses ini memakan waktu beberapa menit. Mohon tunggu dan jangan tutup halaman ini.</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card" style="border-left: 4px solid var(--green);">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #dcfce7; color: var(--green); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="label">Status Sistem</div>
                    <div class="value" style="font-size: 20px; color: var(--green);">Aman & Stabil</div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid var(--primary);">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #dbeafe; color: var(--primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="label">Backup Terakhir</div>
                    <div class="value" style="font-size: 18px;">
                        @if(count($backups ?? []) > 0)
                            {{ $backups[0]['last_modified'] }}
                        @else
                            Belum Ada
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card" style="border-left: 4px solid #8b5cf6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 60px; height: 60px; background: #ede9fe; color: #8b5cf6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                    <i class="fas fa-database"></i>
                </div>
                <div>
                    <div class="label">Total Backup</div>
                    <div class="value">{{ count($backups ?? []) }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Backup Actions Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 12px;">
            <i class="fas fa-plus-circle"></i> Buat Backup Baru
        </h3>
        <p style="color: var(--text-light); margin-bottom: 24px; font-size: 14px;">
            Pilih jenis backup yang ingin dilakukan. Proses ini memakan waktu beberapa menit tergantung ukuran data.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            <!-- Database Backup -->
            <form method="POST" action="{{ route('admin.backup.create') }}" class="backup-form">
                @csrf
                <input type="hidden" name="type" value="database">
                <button type="submit" style="width: 100%; padding: 0; border: none; background: none; cursor: pointer;">
                    <div style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border: 2px solid #93c5fd; border-radius: 12px; padding: 24px; transition: all 0.3s; text-align: left;" onmouseover="this.style.borderColor='var(--primary)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.1)';" onmouseout="this.style.borderColor='#93c5fd'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                        <div style="display: flex; align-items: center; gap: 16px;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #5A67D8 0%, #4C51BF 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; flex-shrink: 0;">
                                <i class="fas fa-database"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="font-weight: 700; color: var(--text-dark); font-size: 16px; margin: 0 0 6px 0;">Database Saja (SQL)</h4>
                                <p style="color: var(--text-light); font-size: 13px; margin: 0 0 8px 0;">Backup data database saja tanpa file</p>
                                <span style="color: var(--primary); font-size: 12px; font-weight: 600;">⚡ Cepat & Ringan</span>
                            </div>
                            <i class="fas fa-arrow-right" style="font-size: 20px; color: var(--primary);"></i>
                        </div>
                    </div>
                </button>
            </form>
        </div>
    </div>

    <!-- Backup History -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-history"></i> Riwayat Backup
            </h3>
            <span style="background: #f3f4f6; padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; color: var(--text-dark); border: 1px solid var(--border);">
                {{ count($backups ?? []) }} file
            </span>
        </div>

        @if(count($backups ?? []) > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th width="45%">Nama File</th>
                            <th width="20%">Tanggal & Waktu</th>
                            <th width="15%">Ukuran</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups ?? [] as $backup)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        @if(strpos($backup['file_name'], '.zip') !== false)
                                            <div style="width: 35px; height: 35px; background: #dcfce7; color: var(--green); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas fa-file-zipper"></i>
                                            </div>
                                        @else
                                            <div style="width: 35px; height: 35px; background: #dbeafe; color: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas fa-file-code"></i>
                                            </div>
                                        @endif
                                        <span style="font-weight: 500; word-break: break-all;">{{ $backup['file_name'] }}</span>
                                    </div>
                                </td>
                                <td style="color: var(--text-light); white-space: nowrap;">
                                    {{ $backup['last_modified'] }}
                                </td>
                                <td>
                                    <span style="background: #f3f4f6; padding: 4px 12px; border-radius: 12px; font-size: 13px; font-weight: 500;">
                                        {{ $backup['file_size'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.backup.download', $backup['file_name']) }}" class="btn-icon" style="color: var(--primary); border-color: var(--primary);" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.backup.delete', $backup['file_name']) }}" style="display: inline;" onsubmit="return confirm('Hapus file backup ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon" style="color: var(--red); border-color: var(--red); background: white; cursor: pointer;" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px;">
                <i class="fas fa-box-open" style="font-size: 64px; color: #d1d5db; margin-bottom: 16px;"></i>
                <h3 style="font-size: 18px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Belum Ada Backup</h3>
                <p style="color: var(--text-light); margin-bottom: 24px;">Mulai dengan membuat backup pertama Anda untuk melindungi data Skill Bridge</p>
                <div style="background: #dbeafe; border: 1px solid #93c5fd; border-radius: 8px; padding: 12px 20px; display: inline-block; font-size: 14px; color: #1e40af;">
                    <i class="fas fa-info-circle"></i> Klik tombol "Buat Backup Baru" di atas untuk memulai
                </div>
            </div>
        @endif
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

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backupForms = document.querySelectorAll('.backup-form');
    const loadingOverlay = document.getElementById('loadingOverlay');

    backupForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const typeInput = this.querySelector('input[name="type"]');
            const type = typeInput.value;
            const message = type === 'database'
                ? 'Mulai backup database SQL? Prosesnya akan memakan waktu beberapa menit.'
                : 'Mulai full backup? Ini akan memakan waktu lebih lama karena termasuk semua file.';

            if (!confirm(message)) {
                e.preventDefault();
                return false;
            }

            // Show loading overlay
            loadingOverlay.style.display = 'flex';
        });
    });
});
</script>
@endsection
