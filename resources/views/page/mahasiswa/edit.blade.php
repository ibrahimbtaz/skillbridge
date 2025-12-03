@extends('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa - Skill Bridge</title>
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

        /* Dynamic List Styling */
        .dynamic-list { margin-top: 16px; }
        .dynamic-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }
        .dynamic-item-group {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
            background: #f9fafb;
        }
        .dynamic-item-group .form-row { margin-bottom: 0; }
        .dynamic-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .dynamic-item-title {
            font-weight: 600;
            color: #4b5563;
            font-size: 14px;
        }

        .btn-remove {
            padding: 8px 14px;
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fca5a5;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 13px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-remove:hover {
            background: #dc2626;
            color: white;
        }

        .btn-add {
            padding: 10px 20px;
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 12px;
        }
        .btn-add:hover {
            background: #dbeafe;
            border-color: #93c5fd;
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
            <h1><i class="fas fa-user-edit"></i> Edit Profil Mahasiswa</h1>
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}" id="editProfileForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-id-card"></i> Biodata</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-input" value="{{ old('nama', $mahasiswa->nama) }}" required>
                    @error('nama') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $mahasiswa->user->email) }}" required>
                        @error('email') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" name="foto_profil" class="form-input" accept="image/*">
                        @if($mahasiswa->foto_profil)
                            <small style="color: #666;">Foto saat ini: {{ basename($mahasiswa->foto_profil) }}</small>
                        @endif
                        @error('foto_profil') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bio Singkat</label>
                    <textarea name="bio" class="form-textarea" placeholder="Tulis bio singkat Anda...">{{ old('bio', $mahasiswa->bio) }}</textarea>
                    @error('bio') <span style="color: var(--error); font-size: 13px;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-graduation-cap"></i> Riwayat Pendidikan</h2>
                </div>

                <div id="educationList" class="dynamic-list">
                    @if($mahasiswa->pendidikan && count($mahasiswa->pendidikan) > 0)
                        @foreach($mahasiswa->pendidikan as $edu)
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item {{ $loop->iteration }}</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Institusi</label>
                                <input type="text" name="edu_institution[]" class="form-input" value="{{ $edu['institution'] ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Jenjang</label>
                                    <input type="text" name="edu_degree[]" class="form-input" value="{{ $edu['degree'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tahun (Contoh: 2015 - 2019)</label>
                                    <input type="text" name="edu_years[]" class="form-input" value="{{ $edu['years'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item 1</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nama Institusi</label>
                                <input type="text" name="edu_institution[]" class="form-input" placeholder="Contoh: Universitas Indonesia">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Jenjang</label>
                                    <input type="text" name="edu_degree[]" class="form-input" placeholder="Contoh: S1 Ilmu Komputer">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tahun</label>
                                    <input type="text" name="edu_years[]" class="form-input" placeholder="Contoh: 2020 - 2024">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn-add" onclick="addEducation()">
                    <i class="fas fa-plus"></i> Tambah Riwayat Pendidikan
                </button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-briefcase"></i> Pengalaman (Kerja/Organisasi)</h2>
                </div>

                <div id="experienceList" class="dynamic-list">
                    @if($mahasiswa->pengalaman && count($mahasiswa->pengalaman) > 0)
                        @foreach($mahasiswa->pengalaman as $exp)
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item {{ $loop->iteration }}</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Posisi/Jabatan</label>
                                <input type="text" name="exp_title[]" class="form-input" value="{{ $exp['title'] ?? '' }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Perusahaan/Organisasi</label>
                                    <input type="text" name="exp_company[]" class="form-input" value="{{ $exp['company'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Waktu (Contoh: Jan 2022 - Sekarang)</label>
                                    <input type="text" name="exp_dates[]" class="form-input" value="{{ $exp['dates'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item 1</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Posisi/Jabatan</label>
                                <input type="text" name="exp_title[]" class="form-input" placeholder="Contoh: Software Engineer Intern">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Perusahaan/Organisasi</label>
                                    <input type="text" name="exp_company[]" class="form-input" placeholder="Contoh: PT. ABC">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Waktu</label>
                                    <input type="text" name="exp_dates[]" class="form-input" placeholder="Contoh: Jan 2023 - Jun 2023">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn-add" onclick="addExperience()">
                    <i class="fas fa-plus"></i> Tambah Pengalaman
                </button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-laptop-code"></i> Skill</h2>
                </div>

                <div id="skillList" class="dynamic-list">
                    @if($mahasiswa->skills && count($mahasiswa->skills) > 0)
                        @foreach($mahasiswa->skills as $skill)
                        <div class="dynamic-item">
                            <input type="text" name="skills[]" class="form-input" value="{{ $skill }}">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    @else
                        <div class="dynamic-item">
                            <input type="text" name="skills[]" class="form-input" placeholder="Contoh: JavaScript">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn-add" onclick="addSkill()">
                    <i class="fas fa-plus"></i> Tambah Skill
                </button>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-link"></i> Kontak Tambahan</h2>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">GitHub</label>
                        <input type="text" name="github" class="form-input" value="{{ old('github', $mahasiswa->kontak_tambahan['github'] ?? '') }}" placeholder="https://github.com/username">
                    </div>
                    <div class="form-group">
                        <label class="form-label">LinkedIn</label>
                        <input type="text" name="linkedin" class="form-input" value="{{ old('linkedin', $mahasiswa->kontak_tambahan['linkedin'] ?? '') }}" placeholder="https://linkedin.com/in/username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Portfolio</label>
                    <input type="text" name="portfolio" class="form-input" value="{{ old('portfolio', $mahasiswa->kontak_tambahan['portfolio'] ?? '') }}" placeholder="https://myportfolio.com">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-language"></i> Bahasa</h2>
                </div>

                <div id="bahasaList" class="dynamic-list">
                    @if($mahasiswa->bahasa && count($mahasiswa->bahasa) > 0)
                        @foreach($mahasiswa->bahasa as $lang)
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item {{ $loop->iteration }}</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Bahasa</label>
                                    <input type="text" name="bahasa_nama[]" class="form-input" value="{{ $lang['nama'] ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Level</label>
                                    <select name="bahasa_level[]" class="form-select">
                                        <option value="Native" {{ ($lang['level'] ?? '') == 'Native' ? 'selected' : '' }}>Native</option>
                                        <option value="Professional" {{ ($lang['level'] ?? '') == 'Professional' ? 'selected' : '' }}>Professional</option>
                                        <option value="Intermediate" {{ ($lang['level'] ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Basic" {{ ($lang['level'] ?? '') == 'Basic' ? 'selected' : '' }}>Basic</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="dynamic-item-group">
                            <div class="dynamic-item-header">
                                <span class="dynamic-item-title">Item 1</span>
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Nama Bahasa</label>
                                    <input type="text" name="bahasa_nama[]" class="form-input" placeholder="Contoh: Indonesia">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Level</label>
                                    <select name="bahasa_level[]" class="form-select">
                                        <option value="Native">Native</option>
                                        <option value="Professional">Professional</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Basic">Basic</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="button" class="btn-add" onclick="addBahasa()">
                    <i class="fas fa-plus"></i> Tambah Bahasa
                </button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi untuk menghapus item
        function removeItem(button) {
            const item = button.closest('.dynamic-item, .dynamic-item-group');
            const list = item.parentElement;

            // Cek agar tidak menghapus item terakhir (opsional)
            // if (list.children.length > 1) {
                item.remove();
            // } else {
            //     alert('Minimal harus ada 1 item.');
            // }
            updateItemTitles(list);
        }

        // Fungsi untuk memperbarui judul "Item 1", "Item 2", dst.
        function updateItemTitles(list) {
            const items = list.querySelectorAll('.dynamic-item-group');
            items.forEach((item, index) => {
                const title = item.querySelector('.dynamic-item-title');
                if (title) {
                    title.textContent = `Item ${index + 1}`;
                }
            });
        }

        // Fungsi tambah Riwayat Pendidikan
        function addEducation() {
            const list = document.getElementById('educationList');
            const item = document.createElement('div');
            item.className = 'dynamic-item-group';
            item.innerHTML = `
                <div class="dynamic-item-header">
                    <span class="dynamic-item-title">Item Baru</span>
                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Institusi</label>
                    <input type="text" name="edu_institution[]" class="form-input" placeholder="Contoh: Universitas Indonesia">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jenjang</label>
                        <input type="text" name="edu_degree[]" class="form-input" placeholder="Contoh: S1 Ilmu Komputer">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tahun</label>
                        <input type="text" name="edu_years[]" class="form-input" placeholder="Contoh: 2020 - 2024">
                    </div>
                </div>
            `;
            list.appendChild(item);
            updateItemTitles(list);
        }

        // Fungsi tambah Pengalaman
        function addExperience() {
            const list = document.getElementById('experienceList');
            const item = document.createElement('div');
            item.className = 'dynamic-item-group';
            item.innerHTML = `
                <div class="dynamic-item-header">
                    <span class="dynamic-item-title">Item Baru</span>
                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="form-group">
                    <label class="form-label">Posisi/Jabatan</label>
                    <input type="text" name="exp_title[]" class="form-input" placeholder="Contoh: Software Engineer Intern">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Perusahaan/Organisasi</label>
                        <input type="text" name="exp_company[]" class="form-input" placeholder="Contoh: PT. ABC">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Waktu</label>
                        <input type="text" name="exp_dates[]" class="form-input" placeholder="Contoh: Jan 2023 - Jun 2023">
                    </div>
                </div>
            `;
            list.appendChild(item);
            updateItemTitles(list);
        }

        // Fungsi tambah Skill
        function addSkill() {
            const list = document.getElementById('skillList');
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <input type="text" name="skills[]" class="form-input" placeholder="Contoh: Python">
                <button type="button" class="btn-remove" onclick="removeItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            list.appendChild(item);
        }

        // Fungsi tambah Bahasa
        function addBahasa() {
            const list = document.getElementById('bahasaList');
            const item = document.createElement('div');
            item.className = 'dynamic-item-group';
            item.innerHTML = `
                <div class="dynamic-item-header">
                    <span class="dynamic-item-title">Item Baru</span>
                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Bahasa</label>
                        <input type="text" name="bahasa_nama[]" class="form-input" placeholder="Contoh: Inggris">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Level</label>
                        <select name="bahasa_level[]" class="form-select">
                            <option value="Native">Native</option>
                            <option value="Professional">Professional</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Basic">Basic</option>
                        </select>
                    </div>
                </div>
            `;
            list.appendChild(item);
            updateItemTitles(list);
        }

        // Update judul saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            updateItemTitles(document.getElementById('educationList'));
            updateItemTitles(document.getElementById('experienceList'));
            updateItemTitles(document.getElementById('bahasaList'));
        });
    </script>
</body>
@endsection
