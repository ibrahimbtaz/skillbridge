@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Lowongan Pekerjaan - Temukan Karir Impianmu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #667eea; /* Biru-Ungu */
            --bg-color: #f4f7f6;
            --card-bg: #ffffff;
            --text-dark: #2d3748;
            --text-light: #718096;
            --border-color: #e2e8f0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Header (dari file PHP) */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }
        .header h1 { font-size: 42px; font-weight: 700; margin-bottom: 12px; }
        .header p { font-size: 18px; opacity: 0.9; margin-bottom: 30px; }
        .stats { display: flex; justify-content: center; gap: 40px; margin-top: 30px; }
        .stat-item { text-align: center; }
        .stat-number { font-size: 32px; font-weight: 700; }
        .stat-label { font-size: 14px; opacity: 0.9; margin-top: 4px; }

        /* Search Section (dari file PHP) */
        .search-section {
            background: white;
            margin: -40px auto 30px;
            max-width: 1200px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .search-form { display: grid; grid-template-columns: 2fr 1.5fr 1fr auto; gap: 12px; margin-bottom: 20px; }
        .search-input, .search-select { padding: 14px 16px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 15px; font-family: inherit; }
        .search-input:focus, .search-select:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1); }
        .search-btn { padding: 14px 32px; background: #667eea; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .search-btn:hover { background: #5568d3; transform: translateY(-2px); }
        .filters { display: flex; gap: 12px; flex-wrap: wrap; }
        .filter-tag { padding: 8px 16px; background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; cursor: pointer; transition: all 0.3s; text-decoration: none; color: #333; }
        .filter-tag:hover { background: #e5e7eb; }
        .filter-tag.active { background: #667eea; color: white; border-color: #667eea; }

        /* Container (Layout List dari Referensi) */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Toolbar (dari file PHP) */
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .results-info { font-size: 15px; color: #6b7280; }
        .results-info strong { color: #1f2937; font-weight: 600; }
        .sort-dropdown { display: flex; align-items: center; gap: 8px; }
        .sort-dropdown label { font-size: 14px; color: #6b7280; }
        .sort-dropdown select { padding: 8px 32px 8px 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; cursor: pointer; background: white; }

        /* == CSS KARTU (Layout List) == */
        a.job-card {
            text-decoration: none;
            color: inherit;
        }

        .job-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 20px; /* Jarak antar kartu */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .job-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            border-left: 4px solid var(--primary-color);
            padding-left: 20px;
        }

        .job-card-content {
            flex: 1;
        }

        .job-header { display: flex; align-items: flex-start; gap: 15px; }
        .job-logo { width: 50px; height: 50px; border-radius: 8px; border: 1px solid var(--border-color); object-fit: contain; }
        .job-info { flex: 1; }
        .job-title { font-size: 1.15em; font-weight: 600; color: var(--text-dark); margin: 0 0 4px 0; text-decoration: none; }
        .job-title:hover { color: var(--primary-color); }
        .job-company { font-size: 0.95em; color: var(--text-light); margin-bottom: 2px; }
        .job-location { font-size: 0.9em; color: var(--text-light); }
        .job-save-btn { font-size: 1.3em; color: #adb5bd; text-decoration: none; padding: 5px; }
        .job-save-btn:hover { color: var(--primary-color); }
        .job-save-btn.saved { color: var(--primary-color); }

        .job-details { margin-top: 20px; display: flex; flex-wrap: wrap; gap: 10px; }
        .job-tag { padding: 6px 14px; border-radius: 20px; font-size: 0.8em; font-weight: 500; display: inline-flex; align-items: center; gap: 6px; }

        /* Warna Tipe Pekerjaan */
        .type-fulltime { background-color: #e0e7ff; color: #4338ca; }
        .type-parttime { background-color: #fef3c7; color: #b45309; }
        .type-contract { background-color: #e0e7ff; color: #4338ca; }
        .type-freelance { background-color: #d1fae5; color: #065f46; }
        .type-internship { background-color: #e0e7ff; color: #4338ca; }

        .type- { background-color: #e0e7ff; color: #4338ca; }
        /* Jenis Pekerjaan - Bold Version */
        .type-fulltime {
            background-color: #e0e7ff;
            color: #4338ca;
            font-weight: 600;
        }
        .type-parttime {
            background-color: #fef08a; /* Kuning lebih cerah */
            color: #a16207; /* Orange-kuning tua */
            font-weight: 600;
        }
        .type-contract {
            background-color: #e9d5ff; /* Ungu lebih cerah */
            color: #6b21a8; /* Ungu lebih gelap */
            font-weight: 600;
        }
        .type-freelance {
            background-color: #a7f3d0; /* Hijau lebih cerah */
            color: #047857; /* Hijau emerald tua */
            font-weight: 600;
        }
        .type-internship {
            background-color: #fbcfe8; /* Pink lebih cerah */
            color: #9f1239; /* Pink-merah tua */
            font-weight: 600;
        }

        /* Tipe Kerja - Bold Version */
        .type-onsite {
            background-color: #fecaca; /* Merah lebih cerah */
            color: #991b1b; /* Merah sangat tua */
            font-weight: 600;
        }
        .type-hybrid {
            background-color: #fed7aa; /* Orange muda */
            color: #c2410c; /* Orange tua */
            font-weight: 600;
        }
        .type-remote {
            background-color: #bfdbfe; /* Biru lebih cerah */
            color: #1e3a8a; /* Biru navy */
            font-weight: 600;
        }

        .salary { background-color: #e2e8f0; color: #334155; }

        .job-footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85em;
            color: var(--text-light);
            border-top: 1px solid #eee;
            padding-top: 16px;
        }

        /* Ini adalah CSS untuk status "Dilihat" */
        .job-status-seen {
            color: var(--primary-color);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* Pagination Styling */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }

        .pagination-wrapper nav {
            display: flex;
            align-items: center;
        }

        .pagination-wrapper nav > div {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            color: #4a5568;
            background: white;
            font-size: 14px;
            transition: all 0.3s;
        }

        .pagination-wrapper a:hover {
            background-color: #f7fafc;
            border-color: #667eea;
            color: #667eea;
        }

        .pagination-wrapper span[aria-current="page"] {
            background-color: #667eea;
            color: white;
            border-color: #667eea;
            font-weight: 600;
        }

        .pagination-wrapper span[aria-disabled="true"] {
            color: #cbd5e0;
            cursor: not-allowed;
            background-color: #f7fafc;
        }

        .pagination-wrapper svg {
            width: 16px;
            height: 16px;
        }

        /* Sembunyikan teks Previous/Next jika ada */
        .pagination-wrapper .hidden {
            display: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 { font-size: 32px; }
            .search-form { grid-template-columns: 1fr; }
            .stats { gap: 20px; }
            .toolbar { flex-direction: column; gap: 16px; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚀 Portal Lowongan Pekerjaan</h1>
        <p>Temukan karir impianmu dari berbagai perusahaan terkemuka</p>
        <div class="stats">
            <div class="stat-item"><div class="stat-number">{{ $total_loker }}+</div><div class="stat-label">Lowongan Aktif</div></div>
            <div class="stat-item"><div class="stat-number">{{ $total_perusahaan }}+</div><div class="stat-label">Perusahaan</div></div>
            <div class="stat-item"><div class="stat-number">999+</div><div class="stat-label">Kandidat Terdaftar</div></div>
        </div>
    </div>

    <div class="search-section">
        <form method="GET" action="{{ route('loker.index') }}" class="search-form">
            <input type="text" class="search-input" name="search" placeholder="Cari posisi atau perusahaan..." value="{{ request('search') }}">
            <select class="search-select" name="lokasi">
                <option value="">Semua Lokasi</option>
                @foreach ($lokasi as $loc)
                    <option value="{{ $loc }}" {{ request('lokasi') == $loc ? 'selected' : '' }}>
                        {{ $loc }}
                    </option>
                @endforeach
            </select>
            <select class="search-select" name="jenis_kerja">
                <option value="">Jenis Pekerjaan</option>
                @foreach ($jenis_kerja as $jenis)
                    <option value="{{ $jenis }}" {{ request('jenis_kerja') == $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="search-btn"><i class="fas fa-search"></i> Cari</button>
        </form>
        {{-- <div class="filters">
             <span style="color: #6b7280; font-size: 14px;">Filter Pengalaman:</span>
            <a href="?experience=" class="filter-tag active">Semua</a>
            <a href="?experience=1-2" class="filter-tag">1-2 Tahun</a>
            <a href="?experience=3-5" class="filter-tag">3-5 Tahun</a>
        </div> --}}
    </div>

    <div class="container">
        <div class="toolbar">
            <div class="results-info">
                Menampilkan <strong>{{ $lokers->firstItem() }} - {{ $lokers->lastItem() }}</strong> dari <strong>{{ $lokers->total() }}</strong> lowongan
            </div>
            <div class="sort-dropdown">
                <label for="sort">Urutkan:</label>
                <select name="sort" onchange="sortJobs(this.value)">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Gaji Tertinggi</option>
                    <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Gaji Terendah</option>
                </select>
            </div>
        </div>

        <div class="job-list-container">
            @foreach ($lokers as $loker)
            <a class="job-card" href="{{ route('loker.show', $loker->id) }}">
                <div class="job-card-content">
                    <div class="job-header">
                        <img class="job-logo" src="{{ asset($loker->mitra->logo) }}" alt="Logo Perusahaan">
                        <div class="job-info">
                            <span class="job-title">{{ $loker->title }}</span>
                            <div class="job-company">{{ $loker->mitra->nama_mitra }}</div>
                            <div class="job-location">{{ $loker->mitra->kota }}, {{ $loker->mitra->provinsi }}</div>
                        </div>
                        <span class="job-save-btn" title="Simpan Pekerjaan">
                            <i class="far fa-bookmark"></i>
                        </span>
                    </div>
                    <div class="job-details">
                        <span class="job-tag type-{{ $loker->jenis_kerja }}">
                            <i class="fas fa-briefcase"></i> {{ $loker->jenis_kerja }}
                        </span>
                        <span class="job-tag type-{{ $loker->tipe_kerja }}">
                            <i class="fas fa-briefcase"></i> {{ $loker->tipe_kerja }}
                        </span>
                        <span class="job-tag salary">
                            <i class="fa-solid fa-rupiah-sign"></i>{{ number_format(round($loker->gaji_min, -6), 0, ',', '.') }} - {{ number_format(round($loker->gaji_max, -6), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <div class="job-footer">
                    <span class="job-status-seen"><i class="fas fa-eye"></i> Dilihat</span>
                    <span class="job-status-date">{{ $loker->created_at->diffForHumans() }}</span>
                </div>
            </a>

            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $lokers->links() }}
        </div>
    </div>
    <script>
        function sortJobs(value) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', value);
            window.location.href = url.toString();
        }
    </script>
</body>
</html>
@endsection
