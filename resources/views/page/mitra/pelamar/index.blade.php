@extends('layout.dashboard.main')

@section('content')
<style>
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.page-header .page-title { margin: 0; }
.summary-grid { display: grid; gap: 16px; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); margin-bottom: 24px; }
.summary-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 10px; padding: 18px; display: flex; flex-direction: column; gap: 4px; }
.summary-label { font-size: 13px; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.05em; }
.summary-value { font-size: 26px; font-weight: 700; color: var(--text-dark); }
.summary-card.pending { border-left: 4px solid #f59e0b; }
.summary-card.reviewed { border-left: 4px solid #3b82f6; }
.summary-card.interview { border-left: 4px solid #8b5cf6; }
.summary-card.accepted { border-left: 4px solid #10b981; }
.summary-card.rejected { border-left: 4px solid #ef4444; }

.filters-card { margin-bottom: 24px; }
.filters-grid { display: flex; flex-wrap: wrap; gap: 14px; }
.filter-field { display: flex; flex-direction: column; gap: 6px; min-width: 200px; }
.filter-label { font-size: 13px; font-weight: 600; color: var(--text-light); }
.filter-select { padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px; }
.filter-select:focus { outline: none; border-color: var(--primary); }

.loker-section { margin-bottom: 30px; }
.loker-header { background: #f8fafc; padding: 16px 20px; border-radius: 10px 10px 0 0; border: 1px solid var(--border); border-bottom: none; display: flex; justify-content: space-between; align-items: center; }
.loker-title { font-size: 18px; font-weight: 600; color: var(--text-dark); }
.loker-meta { font-size: 13px; color: var(--text-light); }
.badge-count { background: var(--primary); color: white; font-size: 12px; padding: 4px 10px; border-radius: 999px; }

.pelamar-list { background: var(--card-bg); border: 1px solid var(--border); border-radius: 0 0 10px 10px; }
.pelamar-item { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-bottom: 1px solid var(--border); }
.pelamar-item:last-child { border-bottom: none; }
.pelamar-info { display: flex; align-items: center; gap: 14px; }
.pelamar-avatar { width: 48px; height: 48px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: 600; color: var(--primary); font-size: 18px; overflow: hidden; }
.pelamar-avatar img { width: 100%; height: 100%; object-fit: cover; }
.pelamar-name { font-weight: 600; color: var(--text-dark); }
.pelamar-detail { font-size: 13px; color: var(--text-light); }
.pelamar-date { font-size: 12px; color: var(--text-light); margin-top: 4px; }

.pelamar-actions { display: flex; align-items: center; gap: 12px; }
.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
.status-pending { background: #fef3c7; color: #b45309; }
.status-reviewed { background: #dbeafe; color: #1d4ed8; }
.status-interview { background: #ede9fe; color: #7c3aed; }
.status-accepted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #b91c1c; }

.btn-icon { padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border); background: #fff; color: var(--text-light); font-size: 13px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; cursor: pointer; transition: all 0.2s; }
.btn-icon:hover { background: #f1f5f9; color: var(--secondary); }
.btn-primary { background: var(--primary); color: white; border: none; }
.btn-primary:hover { background: var(--primary-dark); }

.empty-state { text-align: center; padding: 40px 20px; color: var(--text-light); }
.empty-state i { font-size: 32px; margin-bottom: 12px; }

.alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
.alert-success { background: #d1fae5; color: #065f46; border: 1px solid #10b981; }
.alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }

/* Modal */
.modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; }
.modal.active { display: flex; }
.modal-content { background: white; border-radius: 12px; padding: 24px; max-width: 500px; width: 100%; }
.modal-title { font-size: 20px; font-weight: 700; margin-bottom: 16px; }
.form-group { margin-bottom: 16px; }
.form-label { display: block; font-weight: 500; margin-bottom: 8px; color: var(--text-dark); }
.form-select, .form-textarea { width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; }
.form-textarea { min-height: 100px; resize: vertical; }
.form-buttons { display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; }
.btn-secondary { background: #edf2f7; color: var(--secondary); border: 1px solid var(--border); }
</style>

<div class="content-wrapper">
    <div class="page-header">
        <div>
            <h1 class="page-title">Kelola Pelamar</h1>
            <p class="form-hint" style="margin-top: 6px;">Lihat dan kelola semua pelamar yang melamar ke lowongan Anda.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card">
            <span class="summary-label">Total Pelamar</span>
            <span class="summary-value">{{ $totalPelamar }}</span>
        </div>
        <div class="summary-card pending">
            <span class="summary-label">Menunggu</span>
            <span class="summary-value">{{ $statusCount['pending'] }}</span>
        </div>
        <div class="summary-card reviewed">
            <span class="summary-label">Ditinjau</span>
            <span class="summary-value">{{ $statusCount['reviewed'] }}</span>
        </div>
        <div class="summary-card interview">
            <span class="summary-label">Interview</span>
            <span class="summary-value">{{ $statusCount['interview'] }}</span>
        </div>
        <div class="summary-card accepted">
            <span class="summary-label">Diterima</span>
            <span class="summary-value">{{ $statusCount['accepted'] }}</span>
        </div>
        <div class="summary-card rejected">
            <span class="summary-label">Ditolak</span>
            <span class="summary-value">{{ $statusCount['rejected'] }}</span>
        </div>
    </div>

    <!-- Filter -->
    <div class="content-card filters-card">
        <div class="card-body" style="padding: 20px;">
            <form method="GET" action="{{ route('mitra.pelamar.index') }}">
                <div class="filters-grid">
                    <div class="filter-field">
                        <label class="filter-label">Filter Lowongan</label>
                        <select name="loker_id" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Lowongan</option>
                            @foreach($allLokers as $loker)
                                <option value="{{ $loker->id }}" {{ request('loker_id') == $loker->id ? 'selected' : '' }}>
                                    {{ $loker->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filter-field">
                        <label class="filter-label">Filter Status</label>
                        <select name="status" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Ditinjau</option>
                            <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>Interview</option>
                            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Pelamar per Loker -->
    @forelse($lokers as $loker)
        @if($loker->pelamar->count() > 0)
            <div class="loker-section">
                <div class="loker-header">
                    <div>
                        <div class="loker-title">{{ $loker->title }}</div>
                        <div class="loker-meta">{{ $loker->jenis_kerja }} • {{ $loker->tipe_kerja }}</div>
                    </div>
                    <span class="badge-count">{{ $loker->pelamar->count() }} pelamar</span>
                </div>
                <div class="pelamar-list">
                    @foreach($loker->pelamar as $pelamar)
                        @php
                            $statusLabels = [
                                'pending' => 'Menunggu',
                                'reviewed' => 'Ditinjau',
                                'interview' => 'Interview',
                                'accepted' => 'Diterima',
                                'rejected' => 'Ditolak',
                            ];
                        @endphp
                        <div class="pelamar-item">
                            <div class="pelamar-info">
                                <div class="pelamar-avatar">
                                    @if($pelamar->foto_profil)
                                        <img src="{{ asset('storage/' . $pelamar->foto_profil) }}" alt="{{ $pelamar->nama }}">
                                    @else
                                        {{ strtoupper(substr($pelamar->nama, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="pelamar-name">{{ $pelamar->nama }}</div>
                                    <div class="pelamar-detail">{{ $pelamar->jurusan }} • Semester {{ $pelamar->semester }}</div>
                                    <div class="pelamar-date">
                                        <i class="far fa-clock"></i> Melamar {{ $pelamar->pivot->created_at->diffForHumans() }}
                                    </div>
                                    @if($pelamar->pivot->catatan)
                                        <div class="pelamar-detail" style="margin-top: 4px;">
                                            <i class="far fa-comment"></i> "{{ Str::limit($pelamar->pivot->catatan, 50) }}"
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pelamar-actions">
                                <span class="status-badge status-{{ $pelamar->pivot->status }}">
                                    {{ $statusLabels[$pelamar->pivot->status] }}
                                </span>
                                <a href="{{ route('mahasiswa.profile') }}?id={{ $pelamar->id }}" class="btn-icon" target="_blank">
                                    <i class="fas fa-user"></i> Profil
                                </a>
                                <button class="btn-icon btn-primary" onclick="openUpdateModal({{ $loker->id }}, {{ $pelamar->id }}, '{{ $pelamar->nama }}', '{{ $pelamar->pivot->status }}', '{{ $pelamar->pivot->catatan_mitra ?? '' }}')">
                                    <i class="fas fa-edit"></i> Update
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @empty
        <div class="content-card">
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <p>Belum ada pelamar untuk lowongan Anda.</p>
            </div>
        </div>
    @endforelse

    @if($totalPelamar == 0 && $lokers->count() > 0)
        <div class="content-card">
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <p>Belum ada pelamar untuk lowongan Anda.</p>
            </div>
        </div>
    @endif
</div>

<!-- Modal Update Status -->
<div class="modal" id="updateModal">
    <div class="modal-content">
        <h2 class="modal-title">Update Status Lamaran</h2>
        <p id="modalPelamarName" style="color: var(--text-light); margin-bottom: 16px;"></p>
        
        <form id="updateForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Status</label>
                <select name="status" id="modalStatus" class="form-select" required>
                    <option value="pending">Menunggu</option>
                    <option value="reviewed">Ditinjau</option>
                    <option value="interview">Interview</option>
                    <option value="accepted">Diterima</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Catatan/Feedback untuk Pelamar</label>
                <textarea name="catatan_mitra" id="modalCatatan" class="form-textarea" placeholder="Tulis catatan atau feedback..."></textarea>
            </div>
            
            <div class="form-buttons">
                <button type="button" class="btn btn-secondary" onclick="closeUpdateModal()">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openUpdateModal(lokerId, mahasiswaId, nama, status, catatan) {
    document.getElementById('updateModal').classList.add('active');
    document.getElementById('modalPelamarName').textContent = 'Pelamar: ' + nama;
    document.getElementById('modalStatus').value = status;
    document.getElementById('modalCatatan').value = catatan || '';
    document.getElementById('updateForm').action = '/mitra/pelamar/' + lokerId + '/' + mahasiswaId;
}

function closeUpdateModal() {
    document.getElementById('updateModal').classList.remove('active');
}

document.getElementById('updateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUpdateModal();
    }
});
</script>
@endsection
