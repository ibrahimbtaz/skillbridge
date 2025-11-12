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

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        /* Navigation Bar (Contoh tambahan jika diperlukan) */
        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .nav-btn-primary {
            background: #667eea;
            color: white;
        }

        .nav-btn-primary:hover {
            background: #5568d3;
        }

        /* ... (Gaya CSS lainnya dari file Anda) ... */

        /* Semua gaya CSS dari file list_pekerjaan.php Anda akan ada di sini */
        /* Saya singkat agar tidak terlalu panjang, tapi Anda harus menyalin semua gaya CSS Anda ke sini */
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

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .nav-btn-primary {
            background: #667eea;
            color: white;
        }

        .nav-btn-primary:hover {
            background: #5568d3;
        }

        .nav-btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .nav-btn-secondary:hover {
            background: #e5e7eb;
        }

        .nav-btn-outline {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .nav-btn-outline:hover {
            background: #667eea;
            color: white;
        }

        .header h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .header p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
        }

        .stat-label {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 4px;
        }

        /* Search Section */
        .search-section {
            background: white;
            margin: -40px auto 30px;
            max-width: 1200px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .search-form {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr auto;
            gap: 12px;
            margin-bottom: 20px;
        }

        .search-input, .search-select {
            padding: 14px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
        }

        .search-input:focus, .search-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-btn {
            padding: 14px 32px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }

        .filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-tag {
            padding: 8px 16px;
            background: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tag:hover {
            background: #e5e7eb;
        }

        .filter-tag.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Toolbar */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .results-info {
            font-size: 15px;
            color: #6b7280;
        }

        .results-info strong {
            color: #1f2937;
            font-weight: 600;
        }

        .sort-dropdown {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sort-dropdown label {
            font-size: 14px;
            color: #6b7280;
        }

        .sort-dropdown select {
            padding: 8px 32px 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            background: white;
        }

        /* Job Cards Grid */
        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
        }

        .job-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .job-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            transform: translateY(-4px);
        }

        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: #667eea;
            transform: scaleY(0);
            transition: transform 0.3s;
        }

        .job-card:hover::before {
            transform: scaleY(1);
        }

        .job-header {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }

        .company-logo {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .job-info {
            flex: 1;
        }

        .job-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .company-name {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
            font-size: 13px;
            color: #6b7280;
        }

        .job-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .salary {
            font-size: 16px;
            font-weight: 700;
            color: #059669;
            margin-bottom: 12px;
        }

        .job-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .tag {
            padding: 4px 12px;
            background: #f3f4f6;
            border-radius: 6px;
            font-size: 12px;
            color: #4b5563;
        }

        .tag.type-fulltime { background: #dbeafe; color: #1e40af; }
        .tag.type-parttime { background: #fef3c7; color: #92400e; }
        .tag.type-contract { background: #e0e7ff; color: #4338ca; }
        .tag.type-freelance { background: #fce7f3; color: #9f1239; }
        .tag.type-internship { background: #d1fae5; color: #065f46; }

        .job-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid #e5e7eb;
        }

        .posted-time {
            font-size: 13px;
            color: #9ca3af;
        }

        .job-stats {
            display: flex;
            gap: 16px;
            font-size: 12px;
            color: #9ca3af;
        }

        .job-stats span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
        }

        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 24px;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .empty-state p {
            color: #6b7280;
            margin-bottom: 24px;
        }

        .reset-btn {
            padding: 12px 24px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 32px;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .stats {
                gap: 20px;
            }

            .jobs-grid {
                grid-template-columns: 1fr;
            }

            .toolbar {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }
        }

        /* Loading Animation */
        .loading {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        .loading i {
            font-size: 32px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚀 Portal Lowongan Pekerjaan</h1>
        <p>Temukan karir impianmu dari berbagai perusahaan terkemuka</p>
        
        <div class="stats">
            <div class="stat-item">
                <div class="stat-number">120+</div>
                <div class="stat-label">Lowongan Aktif</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">45+</div>
                <div class="stat-label">Perusahaan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">1000+</div>
                <div class="stat-label">Kandidat Terdaftar</div>
            </div>
        </div>
    </div>

    <div class="search-section">
        <form method="GET" action="" class="search-form">
            <input type="text" 
                   class="search-input" 
                   name="search" 
                   placeholder="Cari posisi atau perusahaan..."
                   value="">
            
            <select class="search-select" name="location">
                <option value="">Semua Lokasi</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Bandung">Bandung</option>
                <option value="Surabaya">Surabaya</option>
            </select>

            <select class="search-select" name="job_type">
                <option value="">Tipe Pekerjaan</option>
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Contract">Contract</option>
                <option value="Freelance">Freelance</option>
                <option value="Internship">Internship</option>
            </select>

            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i> Cari
            </button>
        </form>

        <div class="filters">
            <span style="color: #6b7280; font-size: 14px;">Filter Pengalaman:</span>
            <a href="#" class="filter-tag active">
                Semua
            </a>
            <a href="#" class="filter-tag">
                Fresh Graduate
            </a>
            <a href="#" class="filter-tag">
                1-2 Tahun
            </a>
            <a href="#" classT="filter-tag">
                3-5 Tahun
            </a>
            <a href="#" class="filter-tag">
                5+ Tahun
            </a>
        </div>
    </div>

    <div class="container">
        <div class="toolbar">
            <div class="results-info">
                Menampilkan <strong>2</strong> lowongan
                - <a href="#" style="color: #667eea; text-decoration: none;">Reset Filter</a>
            </div>
            
            <div class="sort-dropdown">
                <label for="sort">Urutkan:</label>
                <select id="sort" name="sort" onchange="sortJobs(this.value)">
                    <option value="latest">Terbaru</option>
                    <option value="salary_high">Gaji Tertinggi</option>
                    <option value="salary_low">Gaji Terendah</option>
                    <option value="most_viewed">Paling Dilihat</option>
                    <option value="most_applied">Paling Banyak Pelamar</option>
                </select>
            </div>
        </div>

        
        <div class="jobs-grid">
            
            <div class="job-card" onclick="window.location.href='job_detail.html'">
                <div class="job-header">
                    <img src="https://via.placeholder.com/60" 
                         alt="Company Logo" 
                         class="company-logo">
                    <div class="job-info">
                        <h3 class="job-title">Senior Frontend Developer</h3>
                        <div class="company-name">Tech Corp</div>
                    </div>
                </div>

                <div class="job-meta">
                    <span><i class="fas fa-map-marker-alt"></i> Jakarta</span>
                    <span><i class="fas fa-clock"></i> 3-5 Tahun</span>
                </div>

                <div class="salary">
                    Rp 15.000.000 - 
                    Rp 25.000.000
                </div>

                <div class="job-tags">
                    <span class="tag type-fulltime">
                        Full Time
                    </span>
                    <span class="tag">Teknologi</span>
                </div>

                <div class="job-footer">
                    <span class="posted-time">
                        <i class="far fa-clock"></i> 2 hari yang lalu
                    </span>
                    <div class="job-stats">
                        <span><i class="far fa-eye"></i> 120</span>
                        <span><i class="far fa-user"></i> 15</span>
                    </div>
                </div>
            </div>

            <div class="job-card" onclick="window.location.href='job_detail.html'">
                <div class="job-header">
                    <img src="https://via.placeholder.com/60" 
                         alt="Company Logo" 
                         class="company-logo">
                    <div class="job-info">
                        <h3 class="job-title">UI/UX Designer (Internship)</h3>
                        <div class="company-name">Design Studio</div>
                    </div>
                </div>

                <div class="job-meta">
                    <span><i class="fas fa-map-marker-alt"></i> Bandung</span>
                    <span><i class="fas fa-clock"></i> Fresh Graduate</span>
                </div>

                <div class="salary">
                    Rp 1.000.000 - 
                    Rp 2.000.000
                </div>

                <div class="job-tags">
                    <span class="tag type-internship">
                        Internship
                    </span>
                    <span class="tag">Desain</span>
                </div>

                <div class="job-footer">
                    <span class="posted-time">
                        <i class="far fa-clock"></i> Hari ini
                    </span>
                    <div class="job-stats">
                        <span><i class="far fa-eye"></i> 80</span>
                        <span><i class="far fa-user"></i> 30</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function sortJobs(value) {
            // Dalam file statis, ini tidak akan berfungsi tanpa reload
            // Dalam file PHP asli, ini akan menambahkan parameter URL
            alert('Mengurutkan berdasarkan: ' + value);
            // const url = new URL(window.location.href);
            // url.searchParams.set('sort', value);
            // window.location.href = url.toString();
        }

        // Smooth scroll to top when clicking job card
        document.querySelectorAll('.job-card').forEach(card => {
            card.addEventListener('click', function(e) {
                // Add a loading indication
                this.style.opacity = '0.7';
            });
        });
    </script>
</body>
</html>
@endsection