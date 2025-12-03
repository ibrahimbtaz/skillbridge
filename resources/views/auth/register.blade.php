<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Registrasi - JobPortal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563EB; /* Modern Blue */
            --primary-dark: #1E40AF;
            --secondary-color: #64748B;
            --bg-color: #F8FAFC;
            --card-hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
        }

        .main-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Header Styling */
        .header-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header-section h1 {
            color: #0f172a;
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            letter-spacing: -0.025em;
        }

        .header-section p {
            color: var(--secondary-color);
            font-size: 1.1rem;
        }

        /* Card Styling */
        .registration-card {
            background: white;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .registration-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
            border-color: var(--primary-color);
        }

        /* Icon Circle */
        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            transition: all 0.3s ease;
        }

        /* Specific Colors for Cards */
        .card-student .icon-wrapper {
            background-color: #EFF6FF; /* Light Blue */
            color: var(--primary-color);
        }

        .card-company .icon-wrapper {
            background-color: #F0FDF4; /* Light Green */
            color: #16A34A;
        }

        .registration-card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #0f172a;
        }

        .card-desc {
            color: var(--secondary-color);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Features List */
        .features-list {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
            text-align: left;
            width: 100%;
        }

        .features-list li {
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            color: #475569;
            display: flex;
            align-items: center;
        }

        .features-list li i {
            margin-right: 10px;
            font-size: 0.8rem;
        }

        .card-student .features-list li i { color: var(--primary-color); }
        .card-company .features-list li i { color: #16A34A; }

        /* Buttons */
        .btn-register {
            margin-top: auto;
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-student {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-student:hover {
            background-color: var(--primary-dark);
            color: white;
        }

        .btn-company {
            background-color: #16A34A;
            color: white;
        }
        .btn-company:hover {
            background-color: #15803d;
            color: white;
        }

        /* Divider */
        .or-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 3rem 0;
            color: #94a3b8;
        }
        .or-divider::before, .or-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #cbd5e1;
        }
        .or-divider span {
            padding: 0 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Login Section */
        .login-section {
            text-align: center;
        }
        .login-text {
            color: var(--secondary-color);
        }
        .login-link {
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }

        /* Animasi Masuk */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>
<body>

    <div class="container main-container animate-fade-up">
        <div class="header-section">
            <h1>Selamat Datang di JobPortal</h1>
            <p>Mulailah perjalanan karir atau temukan talenta terbaik hari ini.</p>
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-md-5">
                <div class="registration-card card-student" onclick="window.location.href='{{ route('register', ['type' => 'mhs']) }}'"> <div class="icon-wrapper">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <h3 class="card-title">Untuk Mahasiswa</h3>
                    <p class="card-desc">Bangun karirmu sejak dini. Temukan magang, part-time, dan pekerjaan impian.</p>

                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Rekomendasi lowongan sesuai jurusan</li>
                        <li><i class="fas fa-check-circle"></i> Bangun CV & Portofolio online</li>
                        <li><i class="fas fa-check-circle"></i> Akses event karir eksklusif</li>
                    </ul>

                    <a href="{{ route('register', ['type' => 'mhs']) }}" class="btn-register btn-student">
                        Daftar Sebagai Mahasiswa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-5">
                <div class="registration-card card-company" onclick="window.location.href='{{ route('register', ['type' => 'mtr']) }}'"> <div class="icon-wrapper">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="card-title">Untuk Perusahaan</h3>
                    <p class="card-desc">Percepat pertumbuhan bisnis Anda dengan merekrut talenta muda berkualitas.</p>

                    <ul class="features-list">
                        <li><i class="fas fa-check-circle"></i> Posting lowongan tanpa batas</li>
                        <li><i class="fas fa-check-circle"></i> Akses database lulusan terbaik</li>
                        <li><i class="fas fa-check-circle"></i> Dashboard manajemen pelamar</li>
                    </ul>

                    <a href="{{ route('register', ['type' => 'mtr']) }}" class="btn-register btn-company">
                        Daftar Sebagai Mitra <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="or-divider">
                    <span>Sudah punya akun?</span>
                </div>

                <div class="login-section">
                    <span class="login-text">Masuk kembali untuk melanjutkan aktivitas Anda.</span>
                    <a href="{{ route('login') }}" class="login-link ms-2">Login disini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional: Add hover effect via JS for extra smoothness if needed,
        // but CSS hover is usually sufficient and more performant.
    </script>
</body>
</html>
