@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-briefcase"></i> Audit Lowongan Kerja
    </h1>

    @if(session('success'))
    <div class="alert alert-success" style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card" style="border-left: 4px solid #3b82f6;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #dbeafe; color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div>
                    <div class="value">{{ $totalLoker }}</div>
                    <div class="label">Total Lowongan</div>
                </div>
            </div>
        </div>
        <div class="stat-card" style="border-left: 4px solid #f59e0b;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #fef3c7; color: #f59e0b; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="value">{{ $pendingCount }}</div>
                    <div class="label">Pending Review</div>
                </div>
            </div>
        </div>
        <div class="stat-card" style="border-left: 4px solid #10b981;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #d1fae5; color: #10b981; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="value">{{ $approvedCount }}</div>
                    <div class="label">Approved</div>
                </div>
            </div>
        </div>
        <div class="stat-card" style="border-left: 4px solid #ef4444;">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="width: 50px; height: 50px; background: #fee2e2; color: #ef4444; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div>
                    <div class="value">{{ $rejectedCount }}</div>
                    <div class="label">Rejected</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Lowongan
        </h3>
        <form method="GET" action="{{ route('admin.audit.loker') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Lowongan
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Perusahaan atau posisi..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
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
                        Tipe Pekerjaan
                    </label>
                    <select name="jenis_kerja" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Tipe</option>
                        <option value="fulltime" {{ request('jenis_kerja') == 'fulltime' ? 'selected' : '' }}>Full Time</option>
                        <option value="parttime" {{ request('jenis_kerja') == 'parttime' ? 'selected' : '' }}>Part Time</option>
                        <option value="freelance" {{ request('jenis_kerja') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="contract" {{ request('jenis_kerja') == 'contract' ? 'selected' : '' }}>Contract</option>
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
                    <a href="{{ route('admin.audit.loker') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        @if(request()->hasAny(['search', 'status', 'jenis_kerja', 'from_date', 'to_date']))
        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span style="font-size: 13px; color: var(--text-light);">Filter aktif:</span>
                @if(request('search'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Pencarian: "{{ request('search') }}"
                    </span>
                @endif
                @if(request('status'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Status: {{ ucfirst(request('status')) }}
                    </span>
                @endif
                @if(request('jenis_kerja'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Tipe: {{ ucfirst(request('jenis_kerja')) }}
                    </span>
                @endif
                @if(request('from_date'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Dari: {{ request('from_date') }}
                    </span>
                @endif
                @if(request('to_date'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Sampai: {{ request('to_date') }}
                    </span>
                @endif
                <span style="font-size: 13px; color: var(--text-light); margin-left: 10px;">
                    ({{ $lokers->count() }} hasil)
                </span>
            </div>
        </div>
        @endif
    </div>

    <!-- Table Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-list"></i> Daftar Lowongan Kerja
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Perusahaan</th>
                        <th width="18%">Posisi</th>
                        <th width="10%">Tipe</th>
                        <th width="12%">Gaji</th>
                        <th width="10%">Lokasi</th>
                        <th width="10%">Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lokers as $loker)
                    <tr>
                        <td>#{{ $loker->id }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @php
                                    $initials = strtoupper(substr($loker->mitra->nama_mitra ?? 'NA', 0, 2));
                                    $colors = ['#dbeafe', '#dcfce7', '#fef3c7', '#fee2e2', '#e0e7ff'];
                                    $textColors = ['#2563eb', '#16a34a', '#92400e', '#dc2626', '#4338ca'];
                                    $colorIndex = $loker->id % count($colors);
                                @endphp
                                <div style="width: 40px; height: 40px; background: {{ $colors[$colorIndex] }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $textColors[$colorIndex] }};">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <div style="font-weight: 600;">{{ $loker->mitra->nama_mitra ?? 'N/A' }}</div>
                                    <div style="font-size: 12px; color: var(--text-light);">{{ $loker->mitra->bidang ?? 'Mitra' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $loker->title }}</td>
                        <td>
                            @php
                                $jenisKerjaStyles = [
                                    'fulltime' => ['bg' => '#dcfce7', 'color' => '#16a34a', 'label' => 'Full Time'],
                                    'parttime' => ['bg' => '#e0e7ff', 'color' => '#4338ca', 'label' => 'Part Time'],
                                    'freelance' => ['bg' => '#fef3c7', 'color' => '#92400e', 'label' => 'Freelance'],
                                    'contract' => ['bg' => '#dbeafe', 'color' => '#2563eb', 'label' => 'Contract'],
                                ];
                                $style = $jenisKerjaStyles[$loker->jenis_kerja] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'label' => ucfirst($loker->jenis_kerja)];
                            @endphp
                            <span style="background: {{ $style['bg'] }}; color: {{ $style['color'] }}; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                {{ $style['label'] }}
                            </span>
                        </td>
                        <td>
                            @if($loker->gaji_min && $loker->gaji_max)
                                Rp {{ number_format($loker->gaji_min, 0, ',', '.') }} - {{ number_format($loker->gaji_max, 0, ',', '.') }}
                            @elseif($loker->gaji_min)
                                Rp {{ number_format($loker->gaji_min, 0, ',', '.') }}
                            @else
                                <span style="color: var(--text-light);">Tidak disebutkan</span>
                            @endif
                        </td>
                        <td>{{ $loker->lokasi }}</td>
                        <td>
                            @php
                                $statusStyles = [
                                    'pending' => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'fa-clock', 'label' => 'Pending'],
                                    'approved' => ['bg' => '#dcfce7', 'color' => '#16a34a', 'icon' => 'fa-check-circle', 'label' => 'Approved'],
                                    'rejected' => ['bg' => '#fee2e2', 'color' => '#dc2626', 'icon' => 'fa-times-circle', 'label' => 'Rejected'],
                                ];
                                $statusStyle = $statusStyles[$loker->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'icon' => 'fa-question', 'label' => ucfirst($loker->status)];
                            @endphp
                            <span style="background: {{ $statusStyle['bg'] }}; color: {{ $statusStyle['color'] }}; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas {{ $statusStyle['icon'] }}"></i> {{ $statusStyle['label'] }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('loker.show', $loker->id) }}" class="btn-icon view" target="_blank" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($loker->status == 'pending')
                                <form action="{{ route('admin.loker.approve', $loker->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menyetujui lowongan ini?')">
                                    @csrf
                                    <button type="submit" class="btn-icon" style="color: var(--green); border-color: var(--green); background: transparent; cursor: pointer;" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.loker.reject', $loker->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menolak lowongan ini?')">
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
                            Tidak ada data lowongan kerja
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
