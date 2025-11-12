@extends('layout.main')

@section('content')

<html lang="id"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna - JobSeeker</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .profile-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }

        .profile-info {
            flex: 1;
        }

        .profile-info h1 {
            color: #333;
            margin-bottom: 5px;
            font-size: 32px;
        }

        .profile-info .job-title {
            color: #667eea;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .profile-info .location {
            color: #666;
            margin-bottom: 15px;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
            margin-top: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            font-size: 14px;
            color: #666;
        }

        .profile-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        /* CARD UTAMA YANG BARU (GABUNGAN) */
        .card {
            background: white;
            border-radius: 15px;
            /* Padding dihilangkan dari sini agar bagian dalam bisa menempel */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            /* margin-bottom dihilangkan */
            overflow: hidden; /* Penting agar border-radius memotong konten di dalamnya */
        }

        /* BAGIAN BARU DI DALAM CARD */
        .card-section {
            padding: 25px; /* Padding dipindahkan ke sini */
            border-bottom: 1px solid #eee; /* Garis pemisah antar bagian */
        }

        /* Hilangkan garis pemisah di bagian terakhir */
        .card .card-section:last-child {
            border-bottom: none;
        }


        /* JUDUL BAGIAN (H2) DIBUAT LEBIH SIMPLE */
        .card h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 22px; 
            font-weight: 600;
            /* Border dan padding bawah dihilangkan agar mirip JobStreet */
            /* padding-bottom: 10px; */
            /* border-bottom: 2px solid #667eea; */
        }

        .about-text {
            color: #666;
            line-height: 1.8;
        }

        .experience-item, .education-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .experience-item:last-child, .education-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .item-title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .item-company {
            color: #667eea;
            margin-bottom: 5px;
        }

        .item-date {
            color: #999;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .item-description {
            color: #666;
            line-height: 1.6;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-tag {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            color: #666;
        }
        
        /* Hilangkan margin-bottom di item kontak terakhir */
        .contact-item:last-child {
            margin-bottom: 0;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Kelas .sidebar tidak diperlukan lagi karena semua jadi satu */
        
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats {
                justify-content: center;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .profile-actions {
                flex-direction: column;
                width: 100%; 
            }
            .btn {
                width: 100%; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-header">
            <div class="profile-picture">AS</div>
            <div class="profile-info">
                <h1>Ahmad Syahputra</h1>
                <div class="job-title">Full Stack Developer</div>
                <div class="location">📍 Jakarta, Indonesia</div>
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number">45</div>
                        <div class="stat-label">Lamaran</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Interview</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Penawaran</div>
                    </div>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn btn-primary">Edit Profil</button>
                <button class="btn btn-secondary">Unduh CV</button>
            </div>
        </div>

        <div class="content-grid">
            <div class="card">
                <div class="card-section">
                    <h2>Tentang Saya</h2>
                    <p class="about-text">
                        Seorang Full Stack Developer dengan pengalaman 5 tahun dalam mengembangkan aplikasi web modern. 
                        Memiliki keahlian dalam JavaScript, React, Node.js, dan berbagai teknologi web terkini. 
                        Passionate dalam menciptakan solusi digital yang inovatif dan user-friendly.
                    </p>
                </div>

                <div class="card-section">
                    <h2>Pengalaman Kerja</h2>
                    <div class="experience-item">
                        <div class="item-title">Senior Full Stack Developer</div>
                        <div class="item-company">PT Tech Innovation</div>
                        <div class="item-date">Jan 2022 - Sekarang</div>
                        <div class="item-description">
                            Memimpin tim pengembangan untuk membuat aplikasi e-commerce skala besar. 
                            Bertanggung jawab dalam arsitektur sistem dan code review.
                        </div>
                    </div>
                    <div class="experience-item">
                        <div class="item-title">Full Stack Developer</div>
                        <div class="item-company">CV Digital Solutions</div>
                        <div class="item-date">Mar 2020 - Des 2021</div>
                        <div class="item-description">
                            Mengembangkan berbagai aplikasi web untuk klien dari berbagai industri. 
                            Fokus pada pengembangan frontend dan backend menggunakan MERN stack.
                        </div>
                    </div>
                    <div class="experience-item">
                        <div class="item-title">Junior Web Developer</div>
                        <div class="item-company">Start-up Indonesia</div>
                        <div class="item-date">Jul 2019 - Feb 2020</div>
                        <div class="item-description">
                            Membantu pengembangan fitur-fitur baru pada platform web perusahaan. 
                            Belajar best practices dalam software development.
                        </div>
                    </div>
                </div>

                <div class="card-section">
                    <h2>Pendidikan</h2>
                    <div class="education-item">
                        <div class="item-title">S1 Teknik Informatika</div>
                        <div class="item-company">Universitas Muria Kudus</div>
                        <div class="item-date">2015 - 2019</div>
                        <div class="item-description">IPK: 3.75 - Fokus pada Web Development dan Software Engineering</div>
                    </div>
                </div>
            
                <div class="card-section">
                    <h2>Keahlian</h2>
                    <div class="skills-container">
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">Node.js</span>
                        <span class="skill-tag">HTML/CSS</span>
                        <span class="skill-tag">MongoDB</span>
                        <span class="skill-tag">PostgreSQL</span>
                        <span class="skill-tag">Git</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">AWS</span>
                        <span class="skill-tag">REST API</span>
                    </div>
                </div>

                <div class="card-section">
                    <h2>Informasi Kontak</h2>
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div>ahmad.syahputra@email.com</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <div>+62 812-3456-7890</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">🔗</div>
                        <div>linkedin.com/in/ahmadsyahputra</div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">💻</div>
                        <div>github.com/ahmadsyahputra</div>
                    </div>
                </div>

                <div class="card-section">
                    <h2>Bahasa</h2>
                    <div class="contact-item">
                        <div style="flex: 1;">
                            <strong>Indonesia</strong><br>
                            <span style="color: #999;">Native</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div style="flex: 1;">
                            <strong>Inggris</strong><br>
                            <span style="color: #999;">Professional</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body></html>


@endsection