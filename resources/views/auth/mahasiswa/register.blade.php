<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mahasiswa - JobPortal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .registration-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 2rem;
        }
        .form-floating > .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 50px;
            padding: 12px 40px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .form-floating {
            margin-bottom: 1rem;
        }
        .required {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="registration-card">
                    <div class="card-header">
                        <h2><i class="fas fa-user-graduate me-3"></i>Registrasi Mahasiswa</h2>
                        <p class="mb-0">Bergabunglah dengan platform pencari kerja terbaik</p>
                    </div>
                    <div class="card-body p-4">
                        <form id="registrationForm" method="POST" action="{{ route('mahasiswa.register') }}" novalidate>
                            @csrf

                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                                <label for="email">Email <span class="required">*</span></label>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                        <label for="password">Password <span class="required">*</span></label>
                                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                                        <label for="password_confirmation">Ulangi Password <span class="required">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM" required>
                                        <label for="nim">NIM <span class="required">*</span></label>
                                        <div class="invalid-feedback">
                                            NIM wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                                        <label for="nama">Nama Lengkap <span class="required">*</span></label>
                                        <div class="invalid-feedback">
                                            Nama lengkap wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" required>
                                            <option value="">Pilih Jurusan</option>
                                            @foreach(['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi'] as $j)
                                                <option value="{{ $j }}" {{ old('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                                            @endforeach
                                        </select>
                                        <label for="jurusan">Jurusan</label>
                                        <div class="invalid-feedback">
                                            Jurusan wajib dipilih.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="semester" name="semester">
                                            <option value="">Sem.</option>
                                            @for($i=1; $i<=8; $i++)
                                                <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>

                                        <label for="semester">Semester</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                <textarea class="form-control" id="alamat" name="alamat" style="height: 100px" placeholder="Alamat">{{ old('alamat') }}</textarea>
                                        <label for="alamat">Alamat Lengkap</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                <input type="tel" class="form-control" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" placeholder="Nomor Telepon">
                                        <label for="no_telp">Nomor Telepon</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Tanggal Lahir">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah punya akun? <a href="{{ route('login')}}" class="text-decoration-none">Login di sini</a></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
        @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">
                        <i class="fas fa-check-circle me-2"></i>Registrasi Berhasil
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem;"></i>
                    <h4>Selamat!</h4>
                    <p>Akun mahasiswa Anda berhasil didaftarkan. Silakan login untuk melanjutkan.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">
                        <i class="fas fa-sign-in-alt me-2"></i>Login Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>


        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            // Hanya tambahkan class validasi
            if (!this.checkValidity()) {
                e.preventDefault(); // Cuma prevent kalau form invalid
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        });

        // Format phone number
        document.getElementById('no_telp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.startsWith('62')) {
                    value = '+' + value;
                } else if (!value.startsWith('0')) {
                    value = '0' + value;
                }
            }
            e.target.value = value;
        });

        // NIM validation (numbers only)
        document.getElementById('nim').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
