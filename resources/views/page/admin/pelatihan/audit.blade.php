@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-clipboard-check"></i> Audit Pelatihan
    </h1>

    @if(session('success'))
    <div class="alert alert-success" style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Pelatihan</div>
            <div class="value">{{ $totalPelatihan }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Pending Review</div>
            <div class="value" style="color: #f59e0b;">{{ $pendingCount }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Approved</div>
            <div class="value" style="color: var(--green);">{{ $approvedCount }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Rejected</div>
            <div class="value" style="color: var(--red);">{{ $rejectedCount }}</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Pelatihan
        </h3>
        <form method="GET" action="{{ route('admin.audit.pelatihan') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pelatihan
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Masukkan judul pelatihan..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status
                    </label>
                    <select name="status" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Review</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Kategori
                    </label>
                    <select name="kategori" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Dari Tanggal
                    </label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Sampai Tanggal
                    </label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div style="display: flex; align-items: flex-end; gap: 10px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.audit.pelatihan') }}" class="btn btn-secondary" style="padding: 10px 15px;">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-list"></i> Daftar Pelatihan
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="10%">Thumbnail</th>
                        <th width="25%">Nama Pelatihan</th>
                        <th width="15%">Kategori</th>
                        <th width="10%">Rating</th>
                        <th width="10%">Status</th>
                        <th width="12%">Tanggal</th>
                        <th width="13%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelatihans as $pelatihan)
                    <tr>
                        <td>#{{ $pelatihan->id }}</td>
                        <td>
                            @if($pelatihan->thumbnail)
                            <img src="{{ asset($pelatihan->thumbnail) }}" alt="{{ $pelatihan->nama_pelatihan }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                            @else
                            <div style="width: 60px; height: 40px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image" style="color: #9ca3af;"></i>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $pelatihan->nama_pelatihan }}</div>
                            <div style="font-size: 12px; color: var(--text-light);">{{ Str::limit($pelatihan->deskripsi, 50) }}</div>
                        </td>
                        <td>
                            <span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                {{ $pelatihan->kategori }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                <span>{{ number_format($pelatihan->rating, 1) }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $statusStyles = [
                                    'pending' => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'fa-clock', 'label' => 'Pending'],
                                    'approved' => ['bg' => '#dcfce7', 'color' => '#16a34a', 'icon' => 'fa-check-circle', 'label' => 'Approved'],
                                    'rejected' => ['bg' => '#fee2e2', 'color' => '#dc2626', 'icon' => 'fa-times-circle', 'label' => 'Rejected'],
                                ];
                                $statusStyle = $statusStyles[$pelatihan->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'icon' => 'fa-question', 'label' => ucfirst($pelatihan->status ?? 'pending')];
                            @endphp
                            <span style="background: {{ $statusStyle['bg'] }}; color: {{ $statusStyle['color'] }}; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas {{ $statusStyle['icon'] }}"></i> {{ $statusStyle['label'] }}
                            </span>
                        </td>
                        <td>
                            <i class="far fa-clock"></i> {{ $pelatihan->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kelola.pelatihan.detail', $pelatihan->id) }}" class="btn-icon view" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($pelatihan->status == 'pending' || $pelatihan->status == null)
                                <form action="{{ route('admin.pelatihan.approve', $pelatihan->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui pelatihan ini?')">
                                    @csrf
                                    <button type="submit" class="btn-icon" style="color: var(--green); border-color: var(--green); background: transparent; cursor: pointer;" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.pelatihan.reject', $pelatihan->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menolak pelatihan ini?')">
                                    @csrf
                                    <button type="submit" class="btn-icon" style="color: var(--red); border-color: var(--red); background: transparent; cursor: pointer;" title="Reject">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-light);">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                            Tidak ada data pelatihan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
