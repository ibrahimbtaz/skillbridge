<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa - JobPortal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563EB;
            --primary-dark: #1E40AF;
            --secondary-color: #64748B;
            --bg-color: #F8FAFC;
            --input-border: #E2E8F0;
            --input-focus: #BFDBFE;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            min-height: 100vh;
            padding: 40px 0;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Poppins', sans-serif;
        }

        /* Container & Card Styling */
        .registration-container {
            max-width: 700px;
            margin: 0 auto;
        }

        .header-text {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header-text h2 {
            font-weight: 700;
            color: #0f172a;
        }

        .header-text p {
            color: var(--secondary-color);
        }

        .registration-card {
            background: white;
            border-radius: 24px;
            border: 1px solid var(--input-border);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
        }

        /* Form Styling */
        .form-section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
            border-bottom: 1px solid var(--input-border);
            padding-bottom: 0.5rem;
        }

        .form-section-title:first-child {
            margin-top: 0;
        }

        .form-floating > .form-control,
        .form-floating > .form-select {
            border-radius: 12px;
            border: 1px solid var(--input-border);
            height: calc(3.5rem + 2px);
        }

        .form-floating > .form-control:focus,
        .form-floating > .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--input-focus);
        }

        .form-floating > label {
            color: var(--secondary-color);
        }

        /* Button Styling */
        .btn-register {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-back {
            color: var(--secondary-color);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1.5rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--primary-color);
        }

        /* Validation Colors */
        .is-invalid {
            border-color: #ef4444 !important;
        }
        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Modal Customization */
        .modal-content {
            border-radius: 24px;
            border: none;
        }
        .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-footer {
            border-top: none;
            padding-top: 0;
            padding-bottom: 2rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .registration-card {
                padding: 1.5rem;
                border-radius: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="registration-container">

            <a href="{{ route('register') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Pilihan
            </a>

            <div class="header-text">
                <h2>Registrasi Mahasiswa</h2>
                <p>Lengkapi data diri Anda untuk mulai mencari peluang karir.</p>
            </div>

            <div class="registration-card">
                <form id="registrationForm" method="POST" action="{{ route('mahasiswa.register') }}" novalidate>
                    @csrf

                    <div class="form-section-title">Informasi Akun</div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        <label for="email">Alamat Email</label>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                <label for="password_confirmation">Ulangi Password</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-section-title">Data Akademik</div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM" required>
                                <label for="nim">Nomor Induk Mahasiswa (NIM)</label>
                                @error('nim') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="" selected disabled>Pilih</option>
                                    @for($i=1; $i<=14; $i++)
                                        <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>Sem. {{ $i }}</option>
                                    @endfor
                                </select>
                                <label for="semester">Semester</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" required>
                            <option value="" selected disabled>Pilih Jurusan Studi</option>
                            @foreach(['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi', 'Ilmu Komunikasi', 'DKV'] as $j)
                                <option value="{{ $j }}" {{ old('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endforeach
                        </select>
                        <label for="jurusan">Jurusan</label>
                        @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-section-title">Data Pribadi</div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                        <label for="nama">Nama Lengkap</label>
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" placeholder="Nomor Telepon">
                                <label for="no_telp">No. WhatsApp/Telepon</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-4">
                        <textarea class="form-control" id="alamat" name="alamat" style="height: 100px" placeholder="Alamat">{{ old('alamat') }}</textarea>
                        <label for="alamat">Alamat Domisili</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-register">
                        <i class="fas fa-paper-plane me-2"></i> Daftar Akun
                    </button>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                            Sudah punya akun? <a href="{{ route('login')}}" class="text-decoration-none fw-bold" style="color: var(--primary-color)">Login disini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div style="width: 70px; height: 70px; background: #DCFCE7; border-radius: 50%; color: #16A34A; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; font-size: 2rem;">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Registrasi Berhasil!</h4>
                    <p class="text-muted mb-4">Akun mahasiswa Anda telah siap. Silakan login untuk melanjutkan.</p>

                    <button type="button" class="btn btn-primary w-100 py-2 rounded-3" onclick="window.location.href='{{ route('login') }}'">
                        Login Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto show modal if session success exists
        @if(session('success'))
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        @endif

        // Form validation styling
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });

        // Format phone number (+62 or 0)
        document.getElementById('no_telp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // NIM validation (numbers only)
        document.getElementById('nim').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
