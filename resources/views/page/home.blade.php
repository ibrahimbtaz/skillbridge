@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Skillbridge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, darkblue 0%, #4a90e2 100%);
            color: white;
            padding: 80px 30px;
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 2.5em;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-button {
            background-color: #ff6b6b;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .hero-button:hover {
            background-color: #ee5a52;
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
        }

        /* Konten Utama */
        .content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .card h3 {
            color: darkblue;
            margin-bottom: 15px;
            font-size: 1.4em;
        }

        .card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .card-button {
            background-color: #4a90e2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .card-button:hover {
            background-color: #357ab8;
        }

        /* Stats Section */
        .stats {
            background-color: darkblue;
            color: white;
            padding: 50px 30px;
            margin: 50px 0;
            border-radius: 10px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            text-align: center;
        }

        .stat-item h4 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #87ceeb;
        }

        .stat-item p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 1.8em;
            }

            .hero p {
                font-size: 1em;
            }

            .content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 40px 20px;
            }

            .hero h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero">
        <h1>Selamat Datang di Skillbridge</h1>
        <p>Tingkatkan skill Anda bersama kami dan raih masa depan yang cerah</p>
        @auth
        <a href="#" class="hero-button">Mulai Belajar</a>
        @else
        <a href="/login" class="hero-button">Masuk Sekarang</a>
        @endauth
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Konten Utama -->
        <div class="content" id="services">
            <div class="card">
                <h3>📚 Kursus Berkualitas</h3>
                <p>Akses ribuan kursus dari instruktur berpengalaman dengan materi yang selalu diperbarui.</p>
                <a href="#" class="card-button">Lihat Kursus</a>
            </div>

            <div class="card">
                <h3>👥 Komunitas Aktif</h3>
                <p>Bergabunglah dengan ribuan pelajar lainnya dan berbagi pengetahuan bersama komunitas.</p>
                <a href="#" class="card-button">Bergabung</a>
            </div>

            <div class="card">
                <h3>🏆 Sertifikat Resmi</h3>
                <p>Dapatkan sertifikat yang diakui industri setelah menyelesaikan setiap kursus.</p>
                <a href="#" class="card-button">Pelajari Lebih</a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <h4>10K+</h4>
                    <p>Peserta Aktif</p>
                </div>
                <div class="stat-item">
                    <h4>500+</h4>
                    <p>Kursus Tersedia</p>
                </div>
                <div class="stat-item">
                    <h4>95%</h4>
                    <p>Kepuasan Pelanggan</p>
                </div>
                <div class="stat-item">
                    <h4>24/7</h4>
                    <p>Support</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
