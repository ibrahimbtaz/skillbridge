@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title with Back Button -->
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
        <a href="{{ route('admin.kelola.pelatihan') }}" class="btn btn-secondary" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="page-title" style="margin: 0;">
            <i class="fas fa-graduation-cap"></i> Detail Pelatihan
        </h1>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <!-- Left Column -->
        <div>
            <!-- Thumbnail Card -->
            <div class="content-card" style="margin-bottom: 20px;">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-image"></i> Thumbnail
                </h3>
                <div style="width: 100%; aspect-ratio: 16/9; border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    @if($pelatihan->thumbnail)
                        <img src="{{ asset($pelatihan->thumbnail) }}" alt="Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fas fa-graduation-cap" style="font-size: 64px;"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Rating Card -->
            <div class="content-card" style="margin-bottom: 20px;">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-star"></i> Rating
                </h3>
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="font-size: 48px; font-weight: 700; color: var(--primary);">
                        {{ number_format($pelatihan->rating, 1) }}
                    </div>
                    <div>
                        <div style="display: flex; gap: 3px; margin-bottom: 5px;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($pelatihan->rating))
                                    <i class="fas fa-star" style="color: #fbbf24; font-size: 20px;"></i>
                                @elseif($i - 0.5 <= $pelatihan->rating)
                                    <i class="fas fa-star-half-alt" style="color: #fbbf24; font-size: 20px;"></i>
                                @else
                                    <i class="far fa-star" style="color: #fbbf24; font-size: 20px;"></i>
                                @endif
                            @endfor
                        </div>
                        <div style="color: var(--text-light); font-size: 14px;">dari 5.0</div>
                    </div>
                </div>
            </div>

            <!-- Tags Card -->
            <div class="content-card">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-tags"></i> Tags
                </h3>
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    @if($pelatihan->tags)
                        @php
                            $tags = is_string($pelatihan->tags) ? json_decode($pelatihan->tags, true) : $pelatihan->tags;
                        @endphp
                        @if(is_array($tags) && count($tags) > 0)
                            @foreach($tags as $tag)
                                <span style="background: var(--primary); color: white; padding: 6px 14px; border-radius: 20px; font-size: 13px;">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        @else
                            <span style="color: var(--text-light);">Tidak ada tags</span>
                        @endif
                    @else
                        <span style="color: var(--text-light);">Tidak ada tags</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Main Info Card -->
            <div class="content-card" style="margin-bottom: 20px;">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-info-circle"></i> Informasi Pelatihan
                </h3>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Nama Pelatihan
                    </label>
                    <div style="font-size: 24px; font-weight: 700; color: var(--text);">
                        {{ $pelatihan->nama_pelatihan }}
                    </div>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                        Kategori
                    </label>
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
                    <span style="background: {{ $color['bg'] }}; color: {{ $color['text'] }}; padding: 6px 14px; border-radius: 6px; font-size: 14px; font-weight: 500;">
                        {{ $pelatihan->kategori }}
                    </span>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                        ID Pelatihan
                    </label>
                    <div style="font-size: 16px; color: var(--text);">
                        #{{ $pelatihan->id }}
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Dibuat Pada
                        </label>
                        <div style="font-size: 14px; color: var(--text);">
                            <i class="far fa-calendar-alt" style="margin-right: 5px;"></i>
                            {{ $pelatihan->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Terakhir Diupdate
                        </label>
                        <div style="font-size: 14px; color: var(--text);">
                            <i class="far fa-clock" style="margin-right: 5px;"></i>
                            {{ $pelatihan->updated_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Card -->
            <div class="content-card" style="margin-bottom: 20px;">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-align-left"></i> Deskripsi
                </h3>
                <div style="color: var(--text); line-height: 1.7; text-align: justify;">
                    {{ $pelatihan->deskripsi }}
                </div>
            </div>

            <!-- Persyaratan Card -->
            <div class="content-card" style="margin-bottom: 20px;">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-clipboard-list"></i> Persyaratan
                </h3>
                @if($pelatihan->persyaratan)
                    @php
                        $persyaratan = is_string($pelatihan->persyaratan) ? json_decode($pelatihan->persyaratan, true) : $pelatihan->persyaratan;
                    @endphp
                    @if(is_array($persyaratan) && count($persyaratan) > 0)
                        <ul style="margin: 0; padding-left: 20px; color: var(--text);">
                            @foreach($persyaratan as $syarat)
                                <li style="margin-bottom: 8px; line-height: 1.5;">{{ $syarat }}</li>
                            @endforeach
                        </ul>
                    @else
                        <div style="color: var(--text-light);">Tidak ada persyaratan khusus</div>
                    @endif
                @else
                    <div style="color: var(--text-light);">Tidak ada persyaratan khusus</div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="content-card">
                <h3 class="card-title" style="margin-bottom: 15px;">
                    <i class="fas fa-cog"></i> Aksi
                </h3>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="{{ route('admin.kelola.pelatihan.edit', $pelatihan->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Pelatihan
                    </a>
                    <form action="{{ route('admin.kelola.pelatihan.delete', $pelatihan->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" style="background: var(--red); border-color: var(--red); color: white;">
                            <i class="fas fa-trash"></i> Hapus Pelatihan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(event) {
        if (!confirm('Apakah Anda yakin ingin menghapus pelatihan "{{ $pelatihan->nama_pelatihan }}"?\n\nTindakan ini tidak dapat dibatalkan.')) {
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
@endsection
