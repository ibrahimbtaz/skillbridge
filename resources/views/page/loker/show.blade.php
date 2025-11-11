@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senior Frontend Developer - Tech Innovators Indonesia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-btn {
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .back-btn:hover {
            color: #2563eb;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #f3f4f6;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .icon-btn:hover {
            background: #e5e7eb;
        }

        .icon-btn.saved {
            background: #fee;
            color: #ef4444;
        }

        /* * KEMBALI KE 2 KOLOM * */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
            margin-top: 24px;
        }

        /* Kartu */
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            /* margin-bottom dihapus agar kartu kiri menyatu */
        }

        /* * KARTU KIRI (GABUNGAN) * */
        /* Padding diletakkan di section internal */
        .job-card-main {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden; /* Agar border-radius rapi */
        }

        /* Bagian di dalam kartu kiri */
        .card-section {
            padding: 24px;
            border-top: 1px solid #e5e7eb; /* Garis pemisah antar bagian */
        }

        .job-header-section {
             padding: 24px;
        }

        /* Job Header */
        .job-header {
            display: flex;
            gap: 20px;
        }

        .company-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid #eee;
        }

        .job-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
        }

        /* * NAMA PERUSAHAAN JADI LINK * */
        .company-name-link {
            font-size: 18px;
            color: #4b5563;
            margin-bottom: 12px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
        }
        .company-name-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }


        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            color: #6b7280;
            font-size: 14px;
        }

        .job-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Section Title */
        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .description {
            color: #4b5563;
            line-height: 1.8;
        }

        /* Lists */
        .list-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
            color: #4b5563;
        }

        .list-item .bullet {
            width: 8px;
            height: 8px;
            background: #2563eb;
            border-radius: 50%;
            margin-right: 12px;
            margin-top: 8px;
            flex-shrink: 0;
        }

        .list-item.requirement .bullet {
            background: #10b981;
        }

        /* Benefits Grid */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 12px;
        }

        .benefit-item {
            display: flex;
            align-items: flex-start;
            padding: 12px;
            background: #eff6ff;
            border-radius: 8px;
        }

        .benefit-item i {
            color: #2563eb;
            margin-right: 10px;
            margin-top: 2px;
        }

        /* * SIDEBAR KANAN KEMBALI STICKY * */
        .sidebar {
            position: sticky;
            top: 100px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #6b7280;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            color: #1f2937;
            text-align: right;
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-success { background: #10b981; color: white; cursor: default; }
        .btn-secondary { background: #f3f4f6; color: #374151; }
        .btn-secondary:hover { background: #e5e7eb; }

        /* Company Info Dihapus dari Sidebar */

        /* Modal (tetap sama) */
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; }
        .modal.active { display: flex; }
        .modal-content { background: white; border-radius: 12px; padding: 32px; max-width: 500px; width: 100%; max-height: 90vh; overflow-y: auto; }
        .modal-title { font-size: 24px; font-weight: 700; margin-bottom: 12px; }
        .modal-text { color: #6b7280; margin-bottom: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 500; margin-bottom: 8px; color: #374151; }
        .form-input, .form-textarea { width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-family: inherit; }
        .form-input:focus, .form-textarea:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
        .form-buttons { display: flex; gap: 12px; }
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #10b981; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }

        /* Responsive */
        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
            .job-header {
                flex-direction: column;
            }
            .benefits-grid {
                grid-template-columns: 1fr;
            }
            .sidebar {
                position: static;
            }
            .job-title {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <a href="{{ route('loker.index') }}" class="back-btn">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                Kembali ke Daftar Lowongan
            </a>
            <div class="header-actions">
                <button class="icon-btn" id="saveBtn">
                    <i class="far fa-heart"></i>
                </button>
                <button class="icon-btn" onclick="shareJob()">
                    <i class="fas fa-share-alt"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-grid">
            <div>
                <div class="job-card-main">
                    <div class="job-header-section" style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div class="job-header">
                            <img src="{{ asset($loker->mitra->logo) }}" alt="Company Logo" class="company-logo">
                            <div style="flex: 1;">
                                <h1 class="job-title">{{ $loker->title }}</h1>
                                <a href="{{ route('mitra.public',  ['id' => $loker->mitra->id, 'loker' => $loker->id]) }}" class="company-name-link">{{ $loker->mitra->nama_mitra }}</a>
                                <div class="job-meta">
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $loker->mitra->kota }}, {{ $loker->mitra->provinsi }}</span>
                                    <span><i class="fas fa-briefcase"></i> {{ $loker->jenis_kerja }}</span>
                                    <span><i class="fas fa-clock"></i> {{ $loker->tipe_kerja }}</span>
                                </div>
                            </div>
                        </div>

                        @if (auth()->check() && auth()->user()->id === $loker->mitra->user_id)
                            <div class="job-actions">
                                <a href="{{ route('mitra.loker.edit', $loker->id) }}" class="">
                                    <i class="fas fa-edit"></i> Edit Loker
                                </a>
                            </div>
                        @endif

                    </div>



                    <div class="card-section">
                        <h2 class="section-title">Deskripsi Pekerjaan</h2>
                        <p class="description">
                            {{ $loker->deskripsi }}
                        </p>
                    </div>

                    <div class="card-section">
    <h2 class="section-title">Tanggung Jawab</h2>
    @forelse ($loker->tanggung_jawab ?? [] as $tanggung_jawab)
        <div class="list-item">
            <div class="bullet"></div>
            <span>{{ $tanggung_jawab }}</span>
        </div>
    @empty
        <div class="list-item">
            <div class="bullet"></div>
            <span>Tidak ada tanggung jawab yang tercantum</span>
        </div>
    @endforelse
</div>

<div class="card-section">
    <h2 class="section-title">Kualifikasi</h2>
    @forelse ($loker->kualifikasi ?? [] as $kualifikasi)
        <div class="list-item requirement">
            <div class="bullet"></div>
            <span>{{ $kualifikasi }}</span>
        </div>
    @empty
        <div class="list-item requirement">
            <div class="bullet"></div>
            <span>Tidak ada kualifikasi yang tercantum</span>
        </div>
    @endforelse
</div>

<div class="card-section">
    <h2 class="section-title">Benefit & Fasilitas</h2>
    <div class="benefits-grid">
        @forelse ($loker->benefits ?? [] as $benefit)
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>{{ $benefit }}</span>
            </div>
        @empty
            <div class="benefit-item">
                <i class="fas fa-check-circle"></i>
                <span>Tidak ada benefit yang tercantum</span>
            </div>
        @endforelse
    </div>
</div>
                </div>
            </div>

            <div class="sidebar">
                <div class="card">
                    <div class="info-row">
                        <span class="info-label">Gaji</span>
                        <span class="info-value">
                            Rp. {{ number_format(round($loker->gaji_min, -6), 0, ',', '.') }} - Rp.{{ number_format(round($loker->gaji_max, -6), 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tipe Pekerjaan</span>
                        <span class="info-value">{{ $loker->jenis_kerja }}</span>
                    </div>
                    {{-- <div class="info-row">
                        <span class="info-label">Pengalaman</span>
                        <span class="info-value">{{ $loker->pengalaman }}</span>
                    </div> --}}
                    <div class="info-row">
                        <span class="info-label">Diposting</span>
                        <span class="info-value">{{ $loker->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Pelamar</span>
                        <span class="info-value">0 orang</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dilihat</span>
                        <span class="info-value">1x</span>
                    </div>

                    <div style="margin-top: 10px; padding: 10px 10px;">
                        <button class="btn btn-primary" id="applyBtn">
                            <i class="fas fa-paper-plane"></i>
                            Lamar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="applyModal">
        </div>

    <script>
        // ... (JavaScript tetap sama) ...
    </script>
</body>
</html>
@endsection
