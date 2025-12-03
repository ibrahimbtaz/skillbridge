<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mitra - JobPortal</title>
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
            max-width: 800px; /* Lebih lebar sedikit karena form perusahaan biasanya lebih detail */
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
            margin-top: 2rem;
            border-bottom: 1px solid var(--input-border);
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-section-title i {
            margin-right: 8px;
            color: var(--primary-color);
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

        .form-text {
            color: var(--secondary-color);
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        /* Upload Area Styling */
        .upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            background: #f8fafc;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .upload-area:hover {
            border-color: var(--primary-color);
            background: #eff6ff;
        }

        .upload-icon {
            font-size: 2.5rem;
            color: #94a3b8;
            margin-bottom: 1rem;
            transition: color 0.3s;
        }

        .upload-area:hover .upload-icon {
            color: var(--primary-color);
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
            color: white;
        }

        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            color: white;
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

        /* Validation & Preview */
        .is-invalid { border-color: #ef4444 !important; }
        .invalid-feedback { font-size: 0.85rem; margin-top: 0.25rem; }

        #logoPreview img {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid var(--input-border);
            padding: 4px;
            background: white;
        }

        /* Modal Customization */
        .modal-content { border-radius: 24px; border: none; }
        .modal-header { border-bottom: none; padding-bottom: 0; }
        .modal-footer { border-top: none; padding-top: 0; padding-bottom: 2rem; }

        @media (max-width: 576px) {
            .registration-card { padding: 1.5rem; }
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
                <h2>Registrasi Mitra Perusahaan</h2>
                <p>Temukan talenta terbaik dan kembangkan bisnis Anda bersama kami.</p>
            </div>

            <div class="registration-card">
                <form id="registrationForm" method="POST" action="{{ route('mitra.register') }}" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-section-title">
                        <i class="fas fa-lock"></i> Informasi Login
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="email@perusahaan.com" required>
                        <label for="email">Email Resmi Perusahaan</label>
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

                    <div class="form-section-title">
                        <i class="fas fa-building"></i> Profil Perusahaan
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('nama_mitra') is-invalid @enderror" id="nama_mitra" name="nama_mitra" value="{{ old('nama_mitra') }}" placeholder="Nama Perusahaan" required>
                        <label for="nama_mitra">Nama Perusahaan (PT/CV/Lainnya)</label>
                        @error('nama_mitra') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select @error('industri') is-invalid @enderror" id="industri" name="industri" required>
                                    <option value="" selected disabled>Pilih Sektor</option>
                                    @foreach(['Teknologi Informasi', 'Keuangan', 'Manufaktur', 'Perdagangan', 'Pendidikan', 'Kesehatan', 'Konstruksi', 'Creative Agency', 'Lainnya'] as $ind)
                                        <option value="{{ $ind }}" {{ old('industri') == $ind ? 'selected' : '' }}>{{ $ind }}</option>
                                    @endforeach
                                </select>
                                <label for="industri">Bidang Industri</label>
                                @error('industri') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}" placeholder="Nomor Telepon">
                                <label for="telepon">No. Telepon Kantor/PIC</label>
                                @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" placeholder="https://">
                        <label for="website">Website Perusahaan</label>
                        <div class="form-text">Contoh: https://perusahaan.com</div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" style="height: 120px" placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>
                        <label for="deskripsi">Deskripsi Singkat Perusahaan</label>
                    </div>

                    <div class="form-section-title">
                        <i class="fas fa-map-marker-alt"></i> Lokasi
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="provinsi" name="provinsi">
                                    <option value="" selected disabled>Pilih Provinsi</option>
                                    <option value="DKI Jakarta">DKI Jakarta</option>
                                    <option value="Jawa Barat">Jawa Barat</option>
                                    <option value="Jawa Tengah">Jawa Tengah</option>
                                    <option value="Jawa Timur">Jawa Timur</option>
                                    </select>
                                <label for="provinsi">Provinsi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="kota" name="kota" value="{{ old('kota') }}" placeholder="Kota">
                                <label for="kota">Kota/Kabupaten</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" style="height: 100px" placeholder="Alamat">{{ old('alamat') }}</textarea>
                        <label for="alamat">Alamat Lengkap</label>
                    </div>

                    <div class="form-section-title">
                        <i class="fas fa-image"></i> Logo Perusahaan
                    </div>

                    <div class="upload-area" onclick="document.getElementById('logo').click()">
                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                        <h5 class="mb-2" style="font-size: 1rem; font-weight: 600;">Upload Logo Perusahaan</h5>
                        <p class="text-muted mb-0 small">Klik untuk memilih file (JPG, PNG). Maksimal 2MB.</p>
                        <input type="file" id="logo" name="logo" accept="image/jpeg,image/png,image/jpg" class="@error('logo') is-invalid @enderror" style="display: none;">
                    </div>
                    @error('logo')
                        <div class="text-danger small mt-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror

                    <div id="logoPreview" class="mt-3 text-center position-relative" style="display: none;">
                        <img id="logoImage" src="" alt="Logo Preview" style="max-height: 100px; border-radius: 8px;">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle position-absolute ms-2" style="width: 30px; height: 30px; padding: 0; line-height: 30px;" onclick="removeLogo()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <button type="submit" class="btn btn-register mt-4">
                        <i class="fas fa-paper-plane me-2"></i> Daftar Mitra Sekarang
                    </button>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">
                            Sudah punya akun mitra? <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--primary-color)">Login disini</a>
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
                    <p class="text-muted mb-2">{{ session('success') }}</p>
                    <small class="d-block text-info mb-4 bg-light p-2 rounded">
                        <i class="fas fa-envelope me-1"></i> Cek email untuk verifikasi.
                    </small>

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
        // Modal Auto Show
        @if(session('success'))
            var myModal = new bootstrap.Modal(document.getElementById('successModal'));
            myModal.show();
        @endif

        // Form Validation Styling
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });

        // Format Phone Number
        document.getElementById('telepon').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('62')) value = '+' + value;
                else if (!value.startsWith('0') && !value.startsWith('+')) value = '0' + value;
            }
            e.target.value = value;
        });

        // Website Formatting
        document.getElementById('website').addEventListener('blur', function(e) {
            const value = e.target.value.trim();
            if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
                e.target.value = 'https://' + value;
            }
        });

        // Logo Upload Handling
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }
                if (!file.type.match(/image\/(jpeg|png|jpg)/)) {
                    alert('File harus berupa gambar (JPG, PNG).');
                    e.target.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('logoImage').src = e.target.result;
                    document.getElementById('logoPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        function removeLogo() {
            document.getElementById('logo').value = '';
            document.getElementById('logoPreview').style.display = 'none';
            document.getElementById('logoImage').src = '';
        }
    </script>
</body>
</html>
