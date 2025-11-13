@extends('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Pelatihan - Skill Bridge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #5A67D8; --secondary: #4A5568;
            --background: #f5f7fa; --card-bg: #ffffff;
            --border: #e2e8f0; --text-dark: #1f2937;
            --text-light: #6b7280;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--background);
            color: var(--text-dark);
        }
        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 40px 20px; text-align: center;
        }
        .header h1 { font-size: 32px; margin-bottom: 10px; }
        /* Search */
        .search-section {
            background: white; margin: -30px auto 30px;
            max-width: 900px; padding: 20px;
            border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .search-form { display: flex; gap: 10px; }
        .search-input {
            flex: 1; padding: 12px 16px; border: 1px solid var(--border);
            border-radius: 8px; font-size: 15px;
        }
        .search-btn {
            padding: 12px 20px; background: var(--primary); color: white;
            border: none; border-radius: 8px; font-size: 15px;
            font-weight: 600; cursor: pointer;
        }
        /* Container */
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .toolbar {
            display: flex; justify-content: space-between;
            align-items: center; margin-bottom: 24px;
        }
        .results-info { font-size: 15px; color: var(--text-light); }
        .sort-dropdown select {
            padding: 8px 12px; border: 1px solid var(--border);
            border-radius: 8px; font-size: 14px; background: white;
        }
        /* Grid Pelatihan */
        .training-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
        }
        .training-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s;
            overflow: hidden;
            text-decoration: none;
            color: var(--text-dark);
        }
        .training-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: translateY(-4px);
        }
        .card-image {
            width: 100%; height: 150px;
            background: #ccc url('https://via.placeholder.com/300x150?text=Gambar+Pelatihan') no-repeat center center;
            background-size: cover;
        }
        .card-content { padding: 20px; }
        .card-title {
            font-size: 18px; font-weight: 700;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .card-instructor {
            font-size: 14px; color: var(--text-light);
            margin-bottom: 12px;
        }
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: var(--text-light);
        }
        .rating { color: #f59e0b; font-weight: 600; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Katalog Pelatihan</h1>
        <p>Temukan skill baru yang relevan dengan industri</p>
    </div>

    <div class="search-section">
        <form method="GET" action="" class="search-form">
            <input type="text" class="search-input" name="search" placeholder="Cari pelatihan... (Contoh: Web Development)">
            <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="container">
        <div class="toolbar">
            <div class="results-info">Menampilkan <strong>3</strong> pelatihan</div>
            <div class="sort-dropdown">
                <select id="sort" name="sort">
                    <option value="latest">Terbaru</option>
                    <option value="popular">Paling Populer</option>
                    <option value="top_rated">Rating Tertinggi</option>
                </select>
            </div>
        </div>

        <div class="training-grid">
            <a href="detail_pelatihan.html" class="training-card">
                <div class="card-image"></div>
                <div class="card-content">
                    <h3 class="card-title">Full-Stack Web Development Bootcamp</h3>
                    <div class="card-instructor">oleh Tech Innovators Academy</div>
                    <div class="card-meta">
                        <span><i class="fas fa-layer-group"></i> Web Development</span>
                        <span class="rating"><i class="fas fa-star"></i> 4.8 (120)</span>
                    </div>
                </div>
            </a>
            <a href="detail_pelatihan.html" class="training-card">
                <div class="card-image" style="background-image: url('https://via.placeholder.com/300x150?text=Data+Science')"></div>
                <div class="card-content">
                    <h3 class="card-title">Data Science Fundamentals with Python</h3>
                    <div class="card-instructor">oleh DataMind Analytics</div>
                    <div class="card-meta">
                        <span><i class="fas fa-database"></i> Data Science</span>
                        <span class="rating"><i class="fas fa-star"></i> 4.7 (95)</span>
                    </div>
                </div>
            </a>
            <a href="detail_pelatihan.html" class="training-card">
                <div class="card-image" style="background-image: url('https://via.placeholder.com/300x150?text=UI/UX+Design')"></div>
                <div class="card-content">
                    <h3 class="card-title">UI/UX Design for Mobile Apps</h3>
                    <div class="card-instructor">oleh CreativeHub Studio</div>
                    <div class="card-meta">
                        <span><i class="fas fa-paint-brush"></i> Desain</span>
                        <span class="rating"><i class="fas fa-star"></i> 4.9 (210)</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
@endsection
