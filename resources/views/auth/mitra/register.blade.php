<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Mitra Perusahaan - JobPortal</title>
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
        .form-floating > .form-control:focus,
        .form-floating > .form-select:focus {
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
        .upload-area {
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            background: rgba(102, 126, 234, 0.2);
        }
        .section-title {
            color: #667eea;
            font-weight: 600;
            margin: 20px 0 15px 0;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="registration-card">
                    <div class="card-header">
                        <h2><i class="fas fa-building me-3"></i>Registrasi Mitra Perusahaan</h2>
                        <p class="mb-0">Bergabunglah sebagai mitra dan temukan talenta terbaik</p>
                    </div>
                    <div class="card-body p-4">
                        <form id="registrationForm" novalidate>
                            <!-- Informasi Perusahaan -->
                            <h4 class="section-title">
                                <i class="fas fa-building me-2"></i>Informasi Perusahaan
                            </h4>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nama_mitra" name="nama_mitra" placeholder="Nama Perusahaan" required>
                                        <label for="nama_mitra">Nama Perusahaan <span class="required">*</span></label>
                                        <div class="invalid-feedback">
                                            Nama perusahaan wajib diisi.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 120px" placeholder="Deskripsi Perusahaan"></textarea>
                                        <label for="deskripsi">Deskripsi Perusahaan</label>
                                        <div class="form-text">Ceritakan tentang visi, misi, dan profil perusahaan Anda</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="industri" name="industri" required>
                                            <option value="">Pilih Industri</option>
                                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                                            <option value="Keuangan">Keuangan</option>
                                            <option value="Manufaktur">Manufaktur</option>
                                            <option value="Perdagangan">Perdagangan</option>
                                            <option value="Pendidikan">Pendidikan</option>
                                            <option value="Kesehatan">Kesehatan</option>
                                            <option value="Konstruksi">Konstruksi</option>
                                            <option value="Transportasi">Transportasi</option>
                                            <option value="Pariwisata">Pariwisata</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                        <label for="industri">Bidang Industri <span class="required">*</span></label>
                                        <div class="invalid-feedback">
                                            Bidang industri wajib dipilih.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Perusahaan" required>
                                        <label for="email">Email Perusahaan <span class="required">*</span></label>
                                        <div class="invalid-feedback">
                                            Email perusahaan wajib diisi dengan format yang benar.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon">
                                        <label for="no_telp">Nomor Telepon</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="url" class="form-control" id="website" name="website" placeholder="Website Perusahaan">
                                        <label for="website">Website Perusahaan</label>
                                        <div class="form-text">Contoh: https://perusahaan.com</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <h4 class="section-title">
                                <i class="fas fa-map-marker-alt me-2"></i>Lokasi Perusahaan
                            </h4>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" id="alamat" name="alamat" style="height: 100px" placeholder="Alamat Lengkap"></textarea>
                                        <label for="alamat">Alamat Lengkap</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="provinsi" name="provinsi">
                                            <option value="">Pilih Provinsi</option>
                                            <option value="DKI Jakarta">DKI Jakarta</option>
                                            <option value="Jawa Barat">Jawa Barat</option>
                                            <option value="Jawa Tengah">Jawa Tengah</option>
                                            <option value="Jawa Timur">Jawa Timur</option>
                                            <option value="Banten">Banten</option>
                                            <option value="Yogyakarta">Yogyakarta</option>
                                            <option value="Bali">Bali</option>
                                            <option value="Sumatera Utara">Sumatera Utara</option>
                                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                                        </select>
                                        <label for="provinsi">Provinsi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="kota" name="kota" placeholder="Kota">
                                        <label for="kota">Kota</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Logo Perusahaan -->
                            <h4 class="section-title">
                                <i class="fas fa-image me-2"></i>Logo Perusahaan
                            </h4>

                            <div class="upload-area" onclick="document.getElementById('logo').click()">
                                <i class="fas fa-cloud-upload-alt text-primary" style="font-size: 2rem;"></i>
                                <p class="mt-2 mb-0">
                                    <strong>Klik untuk upload logo</strong><br>
                                    <small class="text-muted">Format: JPG, PNG, maksimal 2MB</small>
                                </p>
                                <input type="file" id="logo" name="logo" accept="image/*" style="display: none;">
                            </div>
                            <div id="logoPreview" class="mt-3" style="display: none;">
                                <img id="logoImage" src="" alt="Logo Preview" style="max-width: 200px; max-height: 100px; border-radius: 5px;">
                                <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeLogo()">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-building me-2"></i>Daftar Sebagai Mitra
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Sudah terdaftar sebagai mitra? <a href="../page registrasi/registrasiuser.html" class="text-decoration-none">Login di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
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
                    <p>Perusahaan Anda berhasil terdaftar sebagai mitra. Tim kami akan melakukan verifikasi dalam 1-2 hari kerja.</p>
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Anda akan mendapat email konfirmasi setelah proses verifikasi selesai.
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">
                        <i class="fas fa-check me-2"></i>Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (this.checkValidity()) {
                // Simulate registration process
                setTimeout(function() {
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                }, 1000);
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

        // Logo upload handling
        document.getElementById('logo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                    return;
                }

                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar (JPG, PNG).');
                    e.target.value = '';
                    return;
                }

                // Preview image
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

        // Website URL validation
        document.getElementById('website').addEventListener('blur', function(e) {
            const value = e.target.value;
            if (value && !value.startsWith('http://') && !value.startsWith('https://')) {
                e.target.value = 'https://' + value;
            }
        });

        // Email validation
        document.getElementById('email').addEventListener('input', function(e) {
            const email = e.target.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email && !emailRegex.test(email)) {
                e.target.setCustomValidity('Format email tidak valid');
            } else {
                e.target.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
