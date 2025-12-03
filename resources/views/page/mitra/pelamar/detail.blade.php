@extends('layout.dashboard.main')

@section('content')
<style>
.page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
.page-title { margin: 0; }
.back-link { color: var(--text-light); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 16px; }
.back-link:hover { color: var(--primary); }

.loker-info { background: var(--card-bg); border: 1px solid var(--border); border-radius: 10px; padding: 20px; margin-bottom: 24px; }
.loker-info h2 { font-size: 22px; margin-bottom: 8px; }
.loker-meta { color: var(--text-light); font-size: 14px; }
.loker-stats { display: flex; gap: 20px; margin-top: 16px; }
.stat-item { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); }
.stat-item i { color: var(--primary); }

.pelamar-grid { display: grid; gap: 16px; }
.pelamar-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 10px; padding: 20px; }
.pelamar-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
.pelamar-profile { display: flex; align-items: center; gap: 14px; }
.pelamar-avatar { width: 56px; height: 56px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-weight: 600; color: var(--primary); font-size: 20px; overflow: hidden; }
.pelamar-avatar img { width: 100%; height: 100%; object-fit: cover; }
.pelamar-name { font-size: 18px; font-weight: 600; color: var(--text-dark); }
.pelamar-detail { font-size: 13px; color: var(--text-light); margin-top: 4px; }

.status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; text-transform: uppercase; }
.status-pending { background: #fef3c7; color: #b45309; }
.status-reviewed { background: #dbeafe; color: #1d4ed8; }
.status-interview { background: #ede9fe; color: #7c3aed; }
.status-accepted { background: #d1fae5; color: #065f46; }
.status-rejected { background: #fee2e2; color: #b91c1c; }

.pelamar-content { border-top: 1px solid var(--border); padding-top: 16px; }
.content-section { margin-bottom: 16px; }
.content-label { font-size: 12px; font-weight: 600; color: var(--text-light); text-transform: uppercase; margin-bottom: 6px; }
.content-value { color: var(--text-dark); line-height: 1.6; }

.skills-list { display: flex; flex-wrap: wrap; gap: 8px; }
.skill-tag { background: #edf2f7; color: var(--secondary); padding: 4px 10px; border-radius: 999px; font-size: 12px; }

.pelamar-actions { display: flex; gap: 10px; margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--border); }
.btn-icon { padding: 10px 16px; border-radius: 6px; border: 1px solid var(--border); background: #fff; color: var(--text-light); font-size: 13px; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; cursor: pointer; }
.btn-icon:hover { background: #f1f5f9; color: var(--secondary); }
.btn-primary { background: var(--primary); color: white; border: none; }
.btn-primary:hover { background: var(--primary-dark); }
.btn-success { background: #10b981; color: white; border: none; }
.btn-danger { background: #ef4444; color: white; border: none; }

.empty-state { text-align: center; padding: 60px 20px; color: var(--text-light); }
.empty-state i { font-size: 48px; margin-bottom: 16px; }

.alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
.alert-success { background: #d1fae5; color: #065f46; border: 1px solid #10b981; }

/* Quick Actions */
.quick-actions { display: flex; gap: 8px; }
.quick-btn { padding: 6px 10px; border-radius: 4px; border: none; cursor: pointer; font-size: 12px; }
.quick-btn.accept { background: #d1fae5; color: #065f46; }
.quick-btn.reject { background: #fee2e2; color: #b91c1c; }
.quick-btn.interview { background: #ede9fe; color: #7c3aed; }
</style>

<div class="content-wrapper">
    <a href="{{ route('mitra.pelamar.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pelamar
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="loker-info">
        <h2>{{ $loker->title }}</h2>
        <div class="loker-meta">{{ $loker->jenis_kerja }} • {{ $loker->tipe_kerja }} • {{ $loker->lokasi }}</div>
        <div class="loker-stats">
            <div class="stat-item">
                <i class="fas fa-users"></i>
                <span>{{ $loker->pelamar->count() }} Pelamar</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-calendar"></i>
                <span>Deadline: {{ $loker->deadline ? $loker->deadline->format('d M Y') : 'Tidak ada' }}</span>
            </div>
            <div class="stat-item">
                <i class="fas fa-clock"></i>
                <span>Diposting {{ $loker->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h1 class="page-title">Daftar Pelamar</h1>
    </div>

    <div class="pelamar-grid">
        @forelse($loker->pelamar as $pelamar)
            @php
                $statusLabels = [
                    'pending' => 'Menunggu',
                    'reviewed' => 'Ditinjau',
                    'interview' => 'Interview',
                    'accepted' => 'Diterima',
                    'rejected' => 'Ditolak',
                ];
            @endphp
            <div class="pelamar-card">
                <div class="pelamar-header">
                    <div class="pelamar-profile">
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
                            <div class="pelamar-detail">
                                <i class="far fa-envelope"></i> {{ $pelamar->user->email ?? 'N/A' }}
                                @if($pelamar->no_telp)
                                    • <i class="fas fa-phone"></i> {{ $pelamar->no_telp }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span class="status-badge status-{{ $pelamar->pivot->status }}">
                            {{ $statusLabels[$pelamar->pivot->status] }}
                        </span>
                        <div class="pelamar-detail" style="margin-top: 8px;">
                            Melamar {{ $pelamar->pivot->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>

                <div class="pelamar-content">
                    @if($pelamar->pivot->catatan)
                        <div class="content-section">
                            <div class="content-label">Catatan dari Pelamar</div>
                            <div class="content-value">"{{ $pelamar->pivot->catatan }}"</div>
                        </div>
                    @endif

                    @if($pelamar->bio)
                        <div class="content-section">
                            <div class="content-label">Bio</div>
                            <div class="content-value">{{ $pelamar->bio }}</div>
                        </div>
                    @endif

                    @if($pelamar->skills && count($pelamar->skills) > 0)
                        <div class="content-section">
                            <div class="content-label">Skills</div>
                            <div class="skills-list">
                                @foreach($pelamar->skills as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($pelamar->pivot->catatan_mitra)
                        <div class="content-section">
                            <div class="content-label">Feedback Anda</div>
                            <div class="content-value" style="color: var(--primary);">{{ $pelamar->pivot->catatan_mitra }}</div>
                        </div>
                    @endif
                </div>

                <div class="pelamar-actions">
                    <a href="{{ route('mahasiswa.profile') }}?id={{ $pelamar->id }}" class="btn-icon" target="_blank">
                        <i class="fas fa-user"></i> Lihat Profil Lengkap
                    </a>
                    
                    <!-- Quick Action Buttons -->
                    @if($pelamar->pivot->status === 'pending')
                        <form action="{{ route('mitra.pelamar.update', [$loker->id, $pelamar->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="reviewed">
                            <button type="submit" class="btn-icon" style="background: #dbeafe; color: #1d4ed8; border: none;">
                                <i class="fas fa-eye"></i> Tandai Ditinjau
                            </button>
                        </form>
                    @endif

                    @if($pelamar->pivot->status !== 'interview' && $pelamar->pivot->status !== 'accepted' && $pelamar->pivot->status !== 'rejected')
                        <form action="{{ route('mitra.pelamar.update', [$loker->id, $pelamar->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="interview">
                            <button type="submit" class="btn-icon" style="background: #ede9fe; color: #7c3aed; border: none;">
                                <i class="fas fa-calendar-check"></i> Undang Interview
                            </button>
                        </form>
                    @endif

                    @if($pelamar->pivot->status !== 'accepted' && $pelamar->pivot->status !== 'rejected')
                        <form action="{{ route('mitra.pelamar.update', [$loker->id, $pelamar->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="accepted">
                            <button type="submit" class="btn-icon btn-success">
                                <i class="fas fa-check"></i> Terima
                            </button>
                        </form>
                        <form action="{{ route('mitra.pelamar.update', [$loker->id, $pelamar->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="btn-icon btn-danger">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="pelamar-card">
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <p>Belum ada pelamar untuk lowongan ini.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
