@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mitra - Skill Bridge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }
        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px 0;
            margin-bottom: 24px;
        }
        .header-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header h1 i {
            color: #2563eb;
        }
        .back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        .back-btn:hover {
            color: #2563eb;
            background: #eff6ff;
        }

        /* Container & Card */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px 40px 20px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 24px;
        }
        .card-header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e5e7eb;
        }
        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-title i {
            color: #2563eb;
            font-size: 18px;
        }

        /* Form Layout */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group.full-width { grid-column: 1 / -1; }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            color: #1f2937;
            transition: all 0.2s;
            background: white;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }
        .form-input::placeholder, .form-textarea::placeholder {
            color: #9ca3af;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 2px solid #e5e7eb;
        }
        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: #2563eb;
            color: white;
        }
        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            .header-content {
                flex-direction: column;
                gap: 12px;
                align-items: flex-start;
            }
            .back-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1><i class="fas fa-building"></i> Edit Profil Mitra</h1>
            <a href="{{ route('mitra.show') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('mitra.update', $mitra->id) }}" id="editProfileForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-info-circle"></i> Informasi Perusahaan</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="nama_mitra" class="form-input" value="{{ old('nama_mitra', $mitra->nama_mitra) }}" required>
                    @error('nama_mitra') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email Perusahaan</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $mitra->email) }}" required>
                        @error('email') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Logo Perusahaan</label>
                        <input type="file" name="logo" class="form-input" accept="image/*">
                        @if($mitra->logo)
                            <small style="color: #666;">Logo saat ini: {{ basename($mitra->logo) }}</small>
                        @endif
                        @error('logo') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Perusahaan</label>
                    <textarea name="deskripsi" class="form-textarea" placeholder="Jelaskan tentang perusahaan Anda...">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
                    @error('deskripsi') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-briefcase"></i> Detail & Kontak</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Industri</label>
                        <input type="text" name="industri" class="form-input" value="{{ old('industri', $mitra->industri) }}" placeholder="Contoh: Teknologi Informasi">
                        @error('industri') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Website</label>
                        <input type="url" name="website" class="form-input" value="{{ old('website', $mitra->website) }}" placeholder="https://www.perusahaan.com">
                        @error('website') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="telepon" class="form-input" value="{{ old('telepon', $mitra->telepon) }}" placeholder="Contoh: 021-12345678">
                    @error('telepon') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-map-marker-alt"></i> Lokasi</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-textarea" style="min-height: 80px;" placeholder="Alamat lengkap perusahaan...">{{ old('alamat', $mitra->alamat) }}</textarea>
                    @error('alamat') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-input" value="{{ old('kota', $mitra->kota) }}" placeholder="Contoh: Jakarta Selatan">
                        @error('kota') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Provinsi</label>
                        <input type="text" name="provinsi" class="form-input" value="{{ old('provinsi', $mitra->provinsi) }}" placeholder="Contoh: DKI Jakarta">
                        @error('provinsi') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>
</html>
@endsection
