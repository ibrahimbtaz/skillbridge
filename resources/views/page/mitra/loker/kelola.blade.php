@extends('layout.dashboard.main')

@section('content')
<style>
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.page-header .page-title { margin: 0; }
.btn-secondary { background: #edf2f7; color: var(--secondary); border: 1px solid var(--border); }
.btn-secondary:hover { background: #e2e8f0; }
.btn-primary { background: var(--primary); color: #fff; border: none; }
.btn-primary:hover { background: var(--primary-dark); }
.filters-card { margin-bottom: 24px; }
.filters-grid { display: flex; flex-wrap: wrap; gap: 14px; }
.filter-field { display: flex; flex-direction: column; gap: 6px; min-width: 200px; }
.filter-label { font-size: 13px; font-weight: 600; color: var(--text-light); }
.filter-input, .filter-select { padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px; color: var(--secondary); }
.filter-input:focus, .filter-select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(90,103,216,0.2); }
.table-wrapper { width: 100%; overflow-x: auto; }
.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.03em; }
.status-active { background: rgba(16,185,129,0.15); color: var(--green); }
.status-draft { background: #edf2f7; color: var(--text-light); }
.status-closed { background: rgba(229,62,62,0.15); color: var(--red); }
.table-actions { display: flex; gap: 10px; }
.btn-icon { padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border); background: #fff; color: var(--text-light); font-size: 13px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; transition: background 0.2s, color 0.2s, border-color 0.2s; }
.btn-icon:hover { background: #f1f5f9; color: var(--secondary); }
.badge-count { background: rgba(74,85,104,0.1); color: var(--secondary); font-size: 12px; padding: 4px 10px; border-radius: 999px; }
.summary-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 24px; }
.summary-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 10px; padding: 18px; display: flex; flex-direction: column; gap: 4px; }
.summary-label { font-size: 13px; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.05em; }
.summary-value { font-size: 26px; font-weight: 700; color: var(--text-dark); }
.summary-diff { font-size: 12px; font-weight: 600; }
.summary-diff.positive { color: var(--green); }
.summary-diff.negative { color: var(--red); }
.empty-state { text-align: center; padding: 60px 20px; color: var(--text-light); }
.empty-state i { font-size: 32px; margin-bottom: 12px; color: var(--text-light); }
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .filters-grid { flex-direction: column; }
    .table-actions { flex-direction: column; }
}
</style>

<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Lowongan</h1>
            <p class="form-hint" style="margin-top: 6px;">Pantau semua lowongan yang aktif, draft, maupun sudah ditutup.</p>
        </div>
        <a href="{{ route('mitra.loker.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Lowongan
        </a>
    </div>

    <div class="summary-grid">
        <div class="summary-card">
            <span class="summary-label">Total Aktif</span>
            <span class="summary-value">12</span>
            <span class="summary-diff positive"><i class="fas fa-arrow-up"></i> 8% vs bulan lalu</span>
        </div>
        <div class="summary-card">
            <span class="summary-label">Dalam Proses Review</span>
            <span class="summary-value">5</span>
            <span class="summary-diff"><i class="fas fa-clock"></i> Butuh tindakan</span>
        </div>
        <div class="summary-card">
            <span class="summary-label">Ditutup</span>
            <span class="summary-value">18</span>
            <span class="summary-diff negative"><i class="fas fa-arrow-down"></i> 2 posisi expired</span>
        </div>
    </div>

    <div class="content-card filters-card">
        <div class="card-header" style="display:flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 class="card-title">Filter &amp; Pencarian</h2>
                <p class="form-hint">Persempit daftar lowongan sesuai kebutuhan.</p>
            </div>
            <a href="#" class="btn btn-secondary" id="resetFilters">
                <i class="fas fa-rotate"></i>
                Reset
            </a>
        </div>
        <div class="card-body" style="padding: 20px;">
            <div class="filters-grid">
                <div class="filter-field">
                    <label class="filter-label">Cari Judul</label>
                    <input type="text" class="filter-input" placeholder="Masukkan kata kunci...">
                </div>
                <div class="filter-field">
                    <label class="filter-label">Status</label>
                    <select class="filter-select">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="draft">Draft</option>
                        <option value="closed">Ditutup</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">Lokasi</label>
                    <select class="filter-select">
                        <option value="">Semua Lokasi</option>
                        <option>Jakarta</option>
                        <option>Bandung</option>
                        <option>Remote</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">Rentang Tanggal</label>
                    <input type="date" class="filter-input">
                </div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="card-header" style="display:flex; justify-content: space-between; align-items: center;">
            <div style="display:flex; align-items: center; gap: 12px;">
                <h2 class="card-title">Daftar Lowongan</h2>
                <span class="badge-count">17 posisi</span>
            </div>
            <div style="display:flex; gap: 10px;">
                <a href="#" class="btn btn-secondary"><i class="fas fa-file-export"></i> Export</a>
                <a href="#" class="btn btn-secondary"><i class="fas fa-filter"></i> Simpan Filter</a>
            </div>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Posisi</th>
                        <th>Lokasi</th>
                        <th>Tipe</th>
                        <th>Jenis</th>
                        {{-- <th>Status</th>
                        <th>Pelamar</th> --}}
                        <th>Terakhir Diperbarui</th>
                        <th style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lokers as $loker)
                        <tr>
                            <td>
                                <strong>{{ $loker->title }}</strong>
                            </td>
                            <td>{{ $loker->lokasi }}</td>
                            <td>{{ $loker->tipe_kerja }}</td>
                            <td>{{ $loker->jenis_kerja }}</td>
                            {{-- <td><span class="status-badge status-active"><i class="fas fa-circle"></i> Aktif</span></td> --}}
                            {{-- <td>{{ $loker->jumlah_pelamar }}</td> --}}
                            {{-- <td>{{ $loker->updated_at }}</td> --}}
                            <td>
                            <div class="form-hint">{{ $loker->created_at->diffForHumans() }}</div>
                            </td>
                            {{-- <td><span class="status-badge status-active"><i class="fas fa-circle"></i> Aktif</span></td>
                            <td>42</td>
                            <td>09 Nov 2025</td> --}}
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('mitra.loker.edit', $loker->id) }}" class="btn-icon"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="{{ route('mitra.loker.show', $loker->id) }}" class="btn-icon"><i class="fas fa-eye"></i> Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>
                            <strong>UI/UX Designer</strong>
                            <div class="form-hint">Draft disimpan 03 Nov 2025</div>
                        </td>
                        <td>Bandung</td>
                        <td>Contract</td>
                        <td><span class="status-badge status-draft"><i class="fas fa-circle"></i> Draft</span></td>
                        <td>0</td>
                        <td>03 Nov 2025</td>
                        <td>
                            <div class="table-actions">
                                <a href="editloker.html" class="btn-icon"><i class="fas fa-pen"></i> Lanjutkan</a>
                                <a href="#" class="btn-icon"><i class="fas fa-trash"></i> Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>DevOps Engineer</strong>
                            <div class="form-hint">Ditutup otomatis 28 Okt 2025</div>
                        </td>
                        <td>Remote</td>
                        <td>Full Time</td>
                        <td><span class="status-badge status-closed"><i class="fas fa-circle"></i> Ditutup</span></td>
                        <td>87</td>
                        <td>28 Okt 2025</td>
                        <td>
                            <div class="table-actions">
                                <a href="#" class="btn-icon"><i class="fas fa-copy"></i> Duplikat</a>
                                <a href="#" class="btn-icon"><i class="fas fa-file-alt"></i> Lihat Pelamar</a>
                            </div>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="7">
                            <div class="empty-state" id="emptyState" style="display:none;">
                                <i class="fas fa-briefcase"></i>
                                <p>Belum ada lowongan yang sesuai filter. Coba ubah parameter pencarian.</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
const emptyState = document.getElementById('emptyState');
const resetFiltersBtn = document.getElementById('resetFilters');
if (resetFiltersBtn) {
    resetFiltersBtn.addEventListener('click', event => {
        event.preventDefault();
        document.querySelectorAll('.filter-input').forEach(input => input.value = '');
        document.querySelectorAll('.filter-select').forEach(select => select.selectedIndex = 0);
        emptyState.style.display = 'none';
    });
}
</script>
@endsection
