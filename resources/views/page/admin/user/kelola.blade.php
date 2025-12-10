@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-users-cog"></i> Kelola Pengguna
    </h1>

    @if(session('success'))
    <div style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
        <i class="fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
    @endif

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
                    <i class="fas fa-user-shield"></i>
                </div>
                <div>
                    <div class="value">{{ $totalAdmin }}</div>
                    <div class="label">Total Admin</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Add Button Section -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-filter"></i> Filter Pengguna
            </h3>
        </div>
        <form method="GET" action="{{ route('admin.kelola.user') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pengguna
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau email..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Role
                    </label>
                    <select name="role" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Role</option>
                        <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>Mitra</option>
                        <option value="3" {{ request('role') == '3' ? 'selected' : '' }}>Mahasiswa</option>
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
                    <a href="{{ route('admin.kelola.user') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        @if(request()->hasAny(['search', 'role', 'from_date', 'to_date']))
        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span style="font-size: 13px; color: var(--text-light);">Filter aktif:</span>
                @if(request('search'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Pencarian: "{{ request('search') }}"
                    </span>
                @endif
                @if(request('role'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Role: {{ request('role') == '1' ? 'Admin' : (request('role') == '2' ? 'Mitra' : 'Mahasiswa') }}
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
                    ({{ $users->count() }} hasil)
                </span>
            </div>
        </div>
        @endif
    </div>

    <!-- Table Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-list"></i> Daftar Pengguna
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama</th>
                        <th width="25%">Email</th>
                        <th width="12%">Role</th>
                        <th width="18%">Bergabung</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
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
                                <div style="width: 40px; height: 40px; background: {{ $color['bg'] }}; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $color['text'] }}; flex-shrink: 0;">
                                    {{ $initials }}
                                </div>
                                <div>
                                    <div style="font-weight: 600;">{{ $user->mahasiswa->nama ?? $user->name }}</div>
                                    @if($user->role == '3' && $user->mahasiswa)
                                        <div style="font-size: 12px; color: var(--text-light);">NIM: {{ $user->mahasiswa->nim ?? '-' }}</div>
                                    @elseif($user->role == '2' && $user->mitra)
                                        <div style="font-size: 12px; color: var(--text-light);">{{ $user->mitra->bidang ?? 'Mitra' }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @php
                                $roleLabels = [
                                    '1' => ['icon' => 'fa-user-shield', 'label' => 'Admin', 'bg' => '#ede9fe', 'text' => '#8b5cf6'],
                                    '2' => ['icon' => 'fa-building', 'label' => 'Mitra', 'bg' => '#fef3c7', 'text' => '#92400e'],
                                    '3' => ['icon' => 'fa-user-graduate', 'label' => 'Mahasiswa', 'bg' => '#dbeafe', 'text' => '#2563eb'],
                                ];
                                $role = $roleLabels[$user->role] ?? ['icon' => 'fa-user', 'label' => 'User', 'bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="background: {{ $role['bg'] }}; color: {{ $role['text'] }}; padding: 4px 10px; border-radius: 4px; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                                <i class="fas {{ $role['icon'] }}"></i> {{ $role['label'] }}
                            </span>
                        </td>
                        <td>
                            <div style="display: flex; flex-direction: column; gap: 2px;">
                                <span><i class="far fa-calendar" style="color: var(--text-light); margin-right: 5px;"></i>{{ $user->created_at?->format('d M Y') ?? '' }}</span>
                                <span style="font-size: 12px; color: var(--text-light);"><i class="far fa-clock" style="margin-right: 5px;"></i>{{ $user->created_at?->diffForHumans() ?? '' }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kelola.user.edit', $user->id) }}" class="btn-icon" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.kelola.user.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon delete" title="Hapus User" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                <i class="fas fa-users-slash" style="font-size: 48px; color: var(--text-light); opacity: 0.5;"></i>
                                <p style="color: var(--text-light); margin: 0;">Tidak ada pengguna ditemukan</p>
                                @if(request()->hasAny(['search', 'role', 'from_date', 'to_date']))
                                    <a href="{{ route('admin.kelola.user') }}" class="btn btn-secondary" style="margin-top: 10px;">
                                        <i class="fas fa-redo"></i> Reset Filter
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<style>
.action-buttons {
    display: flex;
    gap: 8px;
}

.btn-icon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    color: var(--text-light);
    background: #f3f4f6;
    transition: all 0.2s;
}

.btn-icon:hover {
    background: var(--primary);
    color: white;
}

.btn-icon.delete:hover {
    background: #dc2626;
    color: white;
}
</style>
@endsection
