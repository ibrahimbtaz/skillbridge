@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & Portofolio - {{ $mahasiswa->nama ?? 'Mahasiswa' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5A67D8;
            --background: #f5f7fa;
            --card-bg: #ffffff;
            --border: #e2e8f0;
            --text-dark: #1f2937;
            --text-light: #4b5563;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
        }

        /* Header Aksi di atas CV */
        .action-header {
            background: #4A5568;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .action-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .action-content h1 {
            font-size: 20px;
            color: white;
            font-weight: 600;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }
        .btn-light { background: white; color: #333; }
        .btn-light:hover { background: #f0f0f0; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: #4C51BF; }

        /* Halaman Kertas CV */
        .cv-container {
            max-width: 800px; /* Lebar kertas */
            margin: 24px auto 48px auto;
            background: var(--card-bg);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            min-height: 1123px; /* Tinggi kertas A4 */
            padding: 60px;
        }

        /* Header CV (Nama, Judul, Kontak) */
        .cv-header {
            display: flex;
            gap: 30px;
            align-items: center;
            padding-bottom: 24px;
            border-bottom: 2px solid var(--primary);
        }
        .cv-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ccc;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
            border: 3px solid var(--border);
        }
        .cv-photo-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #5A67D8, #4C51BF);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
            border: 3px solid var(--border);
        }
        .cv-name {
            font-size: 32px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }
        .cv-title {
            font-size: 18px;
            color: var(--primary);
            font-weight: 500;
        }
        .cv-contact {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
            font-size: 14px;
            color: var(--text-light);
        }
        .cv-contact span { display: flex; align-items: center; gap: 6px; }
        .cv-contact a { color: var(--text-light); text-decoration: none; }
        .cv-contact a:hover { color: var(--primary); }

        /* Section CV (Tentang, Pengalaman, dll) */
        .cv-section {
            margin-top: 24px;
        }
        .cv-section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 16px;
        }

        .cv-bio {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.7;
        }

        /* Item untuk Pendidikan/Pengalaman */
        .cv-item {
            margin-bottom: 16px;
        }
        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
        }
        .item-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        .item-date {
            font-size: 14px;
            color: var(--text-light);
            font-style: italic;
            flex-shrink: 0;
            margin-left: 10px;
        }
        .item-subtitle {
            font-size: 15px;
            color: var(--text-light);
            font-weight: 500;
            margin-top: 2px;
        }

        /* Daftar Skill */
        .skill-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skill-tag {
            background: #eff6ff;
            color: #2563eb;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Language list */
        .language-list {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }
        .language-item {
            background: #f3f4f6;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
        }
        .language-name {
            font-weight: 600;
            color: var(--text-dark);
        }
        .language-level {
            color: var(--text-light);
            font-size: 13px;
        }

        /* Empty state */
        .empty-state {
            color: var(--text-light);
            font-style: italic;
            font-size: 14px;
        }

        /* Untuk cetak/PDF */
        @media print {
            body {
                background: none;
            }
            .action-header {
                display: none; /* Sembunyikan header tombol saat cetak */
            }
            .cv-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
                max-width: 100%;
                min-height: 0;
            }
        }
    </style>
</head>
<body>
    <div class="action-header">
        <div class="action-content">
            <h1>CV & Portofolio</h1>
            <div>
                <a href="{{ route('mahasiswa.edit') }}" class="btn btn-light"><i class="fas fa-edit"></i> Edit Profil</a>
                <a href="{{ route('mahasiswa.download-cv') }}" class="btn btn-primary" style="margin-left: 10px;"><i class="fas fa-download"></i> Unduh PDF</a>
            </div>
        </div>
    </div>

    <div class="cv-container">
        {{-- Header CV --}}
        <div class="cv-header">
            @if($mahasiswa->foto_profil)
                <div class="cv-photo" style="background-image: url('{{ asset('storage/' . $mahasiswa->foto_profil) }}');"></div>
            @else
                <div class="cv-photo-placeholder">{{ strtoupper(substr($mahasiswa->nama ?? 'M', 0, 1)) }}</div>
            @endif
            <div>
                <h1 class="cv-name">{{ $mahasiswa->nama ?? 'Nama Mahasiswa' }}</h1>
                <h2 class="cv-title">{{ $mahasiswa->jurusan ?? 'Jurusan' }} - Semester {{ $mahasiswa->semester ?? '-' }}</h2>
                <div class="cv-contact">
                    @if($mahasiswa->user && $mahasiswa->user->email)
                        <span><i class="fas fa-envelope"></i> {{ $mahasiswa->user->email }}</span>
                    @endif
                    @if($mahasiswa->no_telp)
                        <span><i class="fas fa-phone"></i> {{ $mahasiswa->no_telp }}</span>
                    @endif
                    @if($mahasiswa->alamat)
                        <span><i class="fas fa-map-marker-alt"></i> {{ $mahasiswa->alamat }}</span>
                    @endif
                </div>
                @if($mahasiswa->kontak_tambahan)
                    <div class="cv-contact" style="margin-top: 8px;">
                        @if(isset($mahasiswa->kontak_tambahan['linkedin']))
                            <span><i class="fab fa-linkedin"></i> <a href="{{ $mahasiswa->kontak_tambahan['linkedin'] }}" target="_blank">LinkedIn</a></span>
                        @endif
                        @if(isset($mahasiswa->kontak_tambahan['github']))
                            <span><i class="fab fa-github"></i> <a href="{{ $mahasiswa->kontak_tambahan['github'] }}" target="_blank">GitHub</a></span>
                        @endif
                        @if(isset($mahasiswa->kontak_tambahan['portfolio']))
                            <span><i class="fas fa-globe"></i> <a href="{{ $mahasiswa->kontak_tambahan['portfolio'] }}" target="_blank">Portfolio</a></span>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Tentang Saya --}}
        <div class="cv-section">
            <h3 class="cv-section-title">Tentang Saya</h3>
            @if($mahasiswa->bio)
                <p class="cv-bio">{{ $mahasiswa->bio }}</p>
            @else
                <p class="empty-state">Belum ada deskripsi tentang diri. Silakan lengkapi profil Anda.</p>
            @endif
        </div>

        {{-- Pendidikan --}}
        <div class="cv-section">
            <h3 class="cv-section-title">Pendidikan</h3>
            @if($mahasiswa->pendidikan && count($mahasiswa->pendidikan) > 0)
                @foreach($mahasiswa->pendidikan as $edu)
                    <div class="cv-item">
                        <div class="item-header">
                            <span class="item-title">{{ $edu['degree'] ?? '-' }}</span>
                            <span class="item-date">{{ $edu['years'] ?? '' }}</span>
                        </div>
                        <div class="item-subtitle">{{ $edu['institution'] ?? '-' }}</div>
                    </div>
                @endforeach
            @else
                <p class="empty-state">Belum ada data pendidikan. Silakan lengkapi profil Anda.</p>
            @endif
        </div>

        {{-- Pengalaman --}}
        <div class="cv-section">
            <h3 class="cv-section-title">Pengalaman</h3>
            @if($mahasiswa->pengalaman && count($mahasiswa->pengalaman) > 0)
                @foreach($mahasiswa->pengalaman as $exp)
                    <div class="cv-item">
                        <div class="item-header">
                            <span class="item-title">{{ $exp['title'] ?? '-' }}</span>
                            <span class="item-date">{{ $exp['dates'] ?? '' }}</span>
                        </div>
                        <div class="item-subtitle">{{ $exp['company'] ?? '-' }}</div>
                    </div>
                @endforeach
            @else
                <p class="empty-state">Belum ada data pengalaman. Silakan lengkapi profil Anda.</p>
            @endif
        </div>

        {{-- Keahlian --}}
        <div class="cv-section">
            <h3 class="cv-section-title">Keahlian</h3>
            @if($mahasiswa->skills && count($mahasiswa->skills) > 0)
                <div class="skill-list">
                    @foreach($mahasiswa->skills as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <p class="empty-state">Belum ada data keahlian. Silakan lengkapi profil Anda.</p>
            @endif
        </div>

        {{-- Bahasa --}}
        @if($mahasiswa->bahasa && count($mahasiswa->bahasa) > 0)
            <div class="cv-section">
                <h3 class="cv-section-title">Bahasa</h3>
                <div class="language-list">
                    @foreach($mahasiswa->bahasa as $lang)
                        <div class="language-item">
                            <span class="language-name">{{ $lang['nama'] ?? '-' }}</span>
                            @if(isset($lang['level']))
                                <span class="language-level"> - {{ $lang['level'] }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</body>
</html>
@endsection
