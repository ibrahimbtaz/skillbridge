@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV & Portofolio - Ahmad Syahputra</title>
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
            background: #ccc url('https://via.placeholder.com/100') no-repeat center center;
            background-size: cover;
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
                <a href="edit_profil_mahasiswa.html" class="btn btn-light"><i class="fas fa-edit"></i> Edit Profil</a>
                <a href="javascript:window.print()" class="btn btn-primary" style="margin-left: 10px;"><i class="fas fa-download"></i> Unduh PDF</a>
            </div>
        </div>
    </div>

    <div class="cv-container">
        <div class="cv-header">
            <div class="cv-photo"></div>
            <div>
                <h1 class="cv-name">Ahmad Syahputra</h1>
                <h2 class="cv-title">Full Stack Developer</h2>
                <div class="cv-contact">
                    <span><i class="fas fa-envelope"></i> ahmad.syahputra@email.com</span>
                    <span><i class="fab fa-linkedin"></i> linkedin.com/in/ahmadsyahputra</span>
                </div>
            </div>
        </div>

        <div class="cv-section">
            <h3 class="cv-section-title">Tentang Saya</h3>
            <p class="cv-bio">
                Seorang Full Stack Developer dengan pengalaman 5 tahun dalam mengembangkan aplikasi web modern. Memiliki keahlian dalam JavaScript, React, Node.js, dan berbagai teknologi web terkini. Passionate dalam menciptakan solusi digital yang inovatif dan user-friendly.
            </p>
        </div>

        <div class="cv-section">
            <h3 class="cv-section-title">Pengalaman Kerja</h3>
            <div class="cv-item">
                <div class="item-header">
                    <span class="item-title">Senior Full Stack Developer</span>
                    <span class="item-date">Jan 2022 - Sekarang</span>
                </div>
                <div class="item-subtitle">PT Tech Innovation</div>
            </div>
            <div class="cv-item">
                <div class="item-header">
                    <span class="item-title">Full Stack Developer</span>
                    <span class="item-date">Mar 2020 - Des 2021</span>
                </div>
                <div class="item-subtitle">CV Digital Solutions</div>
            </div>
        </div>

        <div class="cv-section">
            <h3 class="cv-section-title">Pendidikan</h3>
            <div class="cv-item">
                <div class="item-header">
                    <span class="item-title">S1 Teknik Informatika</span>
                    <span class="item-date">2015 - 2019</span>
                </div>
                <div class="item-subtitle">Universitas Muria Kudus</div>
            </div>
        </div>

        <div class="cv-section">
            <h3 class="cv-section-title">Keahlian</h3>
            <div class="skill-list">
                <span class="skill-tag">JavaScript</span>
                <span class="skill-tag">React</span>
                <span class="skill-tag">Node.js</span>
                <span class="skill-tag">HTML/CSS</span>
                <span class="skill-tag">MongoDB</span>
                <span class="skill-tag">PostgreSQL</span>
                <span class="skill-tag">Git</span>
                <span class="skill-tag">Docker</span>
                <span class="skill-tag">REST API</span>
            </div>
        </div>

        <div class="cv-section">
            <h3 class="cv-section-title">Pelatihan & Sertifikat</h3>
            <div class="cv-item">
                <div class="item-header">
                    <span class="item-title">Full-Stack Web Development Bootcamp</span>
                    <span class="item-date">2023</span>
                </div>
                <div class="item-subtitle">Tech Innovators Academy</div>
            </div>
            <div class="cv-item">
                <div class="item-header">
                    <span class="item-title">Data Science Fundamentals</span>
                    <span class="item-date">2022</span>
                </div>
                <div class="item-subtitle">DataMind Analytics</div>
            </div>
        </div>

    </div>
</body>
</html>
@endsection
