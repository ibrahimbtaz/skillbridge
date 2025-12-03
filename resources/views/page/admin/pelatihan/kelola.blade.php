@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-graduation-cap"></i> Kelola Pelatihan
    </h1>

    @if(session('success'))
    <div style="background: #dcfce7; color: #16a34a; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
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
            <div class="label">Aktif</div>
            <div class="value" style="color: var(--green);">{{ $totalPelatihan }}</div>
        </div>
        <div class="stat-card">
            <div class="label">Draft</div>
            <div class="value" style="color: #f59e0b;">0</div>
        </div>
        <div class="stat-card">
            <div class="label">Total Peserta</div>
            <div class="value">0</div>
        </div>
    </div>

    <!-- Filter & Add Button Section -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-filter"></i> Filter Pelatihan
            </h3>
            <a href="{{ route('admin.kelola.pelatihan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pelatihan
            </a>
        </div>
        <form method="GET" action="{{ route('admin.kelola.pelatihan') }}">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pelatihan
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Judul pelatihan..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
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
                        Rating
                    </label>
                    <select name="rating" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Rating</option>
                        <option value="4+" {{ request('rating') == '4+' ? 'selected' : '' }}>⭐ 4 ke atas</option>
                        <option value="3+" {{ request('rating') == '3+' ? 'selected' : '' }}>⭐ 3 ke atas</option>
                        <option value="2+" {{ request('rating') == '2+' ? 'selected' : '' }}>⭐ 2 ke atas</option>
                        <option value="1+" {{ request('rating') == '1+' ? 'selected' : '' }}>⭐ 1 ke atas</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Urutkan
                    </label>
                    <select name="sort" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                        <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama Z-A</option>
                        <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>Rating Tertinggi</option>
                        <option value="rating_asc" {{ request('sort') == 'rating_asc' ? 'selected' : '' }}>Rating Terendah</option>
                    </select>
                </div>
                <div style="display: flex; align-items: flex-end; gap: 10px;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.kelola.pelatihan') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                        <i class="fas fa-redo"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        @if(request()->hasAny(['search', 'kategori', 'rating', 'sort']))
        <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <span style="font-size: 13px; color: var(--text-light);">Filter aktif:</span>
                @if(request('search'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Pencarian: "{{ request('search') }}"
                    </span>
                @endif
                @if(request('kategori'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Kategori: {{ request('kategori') }}
                    </span>
                @endif
                @if(request('rating'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Rating: {{ request('rating') }}
                    </span>
                @endif
                @if(request('sort'))
                    <span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 20px; font-size: 12px;">
                        Urutan: {{ request('sort') }}
                    </span>
                @endif
                <span style="font-size: 13px; color: var(--text-light); margin-left: 10px;">
                    ({{ $pelatihans->count() }} hasil)
                </span>
            </div>
        </div>
        @endif
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
                        <th width="5%">No</th>
                        <th width="30%">Judul Pelatihan</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Rating</th>
                        <th width="20%">Tags</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelatihans as $index => $pelatihan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                @if($pelatihan->thumbnail)
                                <img src="{{ asset($pelatihan->thumbnail) }}" alt="Thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; flex-shrink: 0;">
                                @else
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                @endif
                                <div>
                                    <div style="font-weight: 600;">{{ $pelatihan->nama_pelatihan }}</div>
                                    <div style="font-size: 12px; color: var(--text-light);">{{ Str::limit($pelatihan->deskripsi, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                                $kategoriColors = [
                                    'Programming' => ['bg' => '#dbeafe', 'text' => '#2563eb'],
                                    'Design' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                                    'Business' => ['bg' => '#e0e7ff', 'text' => '#4338ca'],
                                    'Marketing' => ['bg' => '#fce7f3', 'text' => '#be185d'],
                                    'Data Science' => ['bg' => '#dcfce7', 'text' => '#16a34a'],
                                ];
                                $color = $kategoriColors[$pelatihan->kategori] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
                            @endphp
                            <span style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 4px 10px; border-radius: 4px; font-size: 12px;">{{ $pelatihan->kategori }}</span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">{{ number_format($pelatihan->rating, 1) }}</span>
                            </div>
                        </td>
                        <td>
                            @if($pelatihan->tags)
                                @php
                                    $tags = is_string($pelatihan->tags) ? json_decode($pelatihan->tags, true) : $pelatihan->tags;
                                @endphp
                                @if(is_array($tags))
                                    @foreach(array_slice($tags, 0, 3) as $tag)
                                        <span style="background: #f3f4f6; color: #374151; padding: 2px 8px; border-radius: 4px; font-size: 11px; margin-right: 3px;">{{ $tag }}</span>
                                    @endforeach
                                @endif
                            @else
                                <span style="color: var(--text-light);">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kelola.pelatihan.detail', $pelatihan->id) }}" class="btn-icon view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.kelola.pelatihan.edit', $pelatihan->id) }}" class="btn-icon">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kelola.pelatihan.delete', $pelatihan->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event, '{{ $pelatihan->nama_pelatihan }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon" style="color: var(--red); border-color: var(--red); background: transparent; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <i class="fas fa-folder-open" style="font-size: 48px; color: var(--text-light); margin-bottom: 10px;"></i>
                            <p style="color: var(--text-light);">Belum ada data pelatihan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(event, name) {
        if (!confirm('Apakah Anda yakin ingin menghapus pelatihan "' + name + '"?\n\nTindakan ini tidak dapat dibatalkan.')) {
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
@endsection
