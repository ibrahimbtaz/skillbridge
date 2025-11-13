<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Registrasi - JobPortal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .header-section h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .header-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .registration-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            cursor: pointer;
            position: relative;
        }

        .registration-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
        }

        .card-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .card-icon i {
            font-size: 4rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }

        .card-icon h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            position: relative;
            z-index: 2;
        }

        .card-body {
            padding: 30px;
            text-align: center;
        }

        .card-body h4 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.3rem;
        }

        .card-body p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .features-list {
            text-align: left;
            margin: 20px 0;
        }

        .features-list li {
            color: #555;
            margin-bottom: 8px;
            position: relative;
            padding-left: 20px;
        }

        .features-list li::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            color: #667eea;
            position: absolute;
            left: 0;
            top: 0;
        }

        .or-divider {
            text-align: center;
            margin: 40px 0;
            position: relative;
        }

        .or-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.3;
        }

        .or-divider span {
            background: white;
            color: #667eea;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 50px;
            position: relative;
            z-index: 2;
            border: 2px solid #667eea;
        }

        .login-section {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .login-section p {
            color: white;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }

        .btn-login {
            background: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: white;
            color: #667eea;
        }

        @media (max-width: 768px) {
            .header-section h1 {
                font-size: 2rem;
            }

            .card-icon {
                padding: 30px;
            }

            .card-icon i {
                font-size: 3rem;
            }

            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container main-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1><i class="fas fa-user-plus me-3"></i>Daftar Akun Baru</h1>
            <p>Pilih jenis akun yang sesuai dengan kebutuhan Anda</p>
        </div>

        <!-- Registration Options -->
        <div class="row g-4">
            <!-- Mahasiswa Registration -->
            <div class="col-md-6">
                <div class="registration-card" onclick="window.location.href='registrasimahasiswa.html'">
                    <div class="card-icon">
                        <i class="fas fa-user-graduate"></i>
                        <h3>Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <h4>Daftar sebagai Mahasiswa</h4>
                        <p>Temukan peluang magang, part-time, dan pekerjaan fresh graduate yang sesuai dengan jurusan Anda.</p>

                        <ul class="features-list">
                            <li>Cari lowongan berdasarkan jurusan</li>
                            <li>Akses pelatihan dan workshop gratis</li>
                            <li>Portfolio online untuk CV</li>
                            <li>Notifikasi lowongan terbaru</li>
                            <li>Konsultasi karir dengan mentor</li>
                        </ul>

                        <a href="{{ route('mahasiswa.register') }}" class="btn-register">
                            <i class="fas fa-graduation-cap me-2"></i>Daftar Mahasiswa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mitra Registration -->
            <div class="col-md-6">
                <div class="registration-card" onclick="window.location.href='registrasimitra.html'">
                    <div class="card-icon">
                        <i class="fas fa-building"></i>
                        <h3>Perusahaan</h3>
                    </div>
                    <div class="card-body">
                        <h4>Daftar sebagai Mitra</h4>
                        <p>Rekrut talenta terbaik dari berbagai universitas dan temukan kandidat yang tepat untuk perusahaan Anda.</p>

                        <ul class="features-list">
                            <li>Posting lowongan kerja unlimited</li>
                            <li>Database mahasiswa terverifikasi</li>
                            <li>Sistem tracking kandidat</li>
                            <li>Analytics dan laporan rekrutmen</li>
                            <li>Branding perusahaan di platform</li>
                        </ul>

                        <a href="{{ route('mitra.register') }}" class="btn-register">
                            <i class="fas fa-handshake me-2"></i>Daftar Mitra
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- OR Divider -->
        <div class="or-divider">
            <span>ATAU</span>
        </div>

        <!-- Login Section -->
        <div class="login-section">
            <p><i class="fas fa-sign-in-alt me-2"></i>Sudah memiliki akun?</p>
            <a href="registrasiuser.html" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add click animations
        document.querySelectorAll('.registration-card').forEach(card => {
            card.addEventListener('mousedown', function() {
                this.style.transform = 'translateY(-5px) scale(0.98)';
            });

            card.addEventListener('mouseup', function() {
                this.style.transform = 'translateY(-10px) scale(1)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Smooth scroll animation on page load
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transform = 'translateY(20px)';
            document.body.style.transition = 'all 0.6s ease';

            setTimeout(function() {
                document.body.style.opacity = '1';
                document.body.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>
</html>
