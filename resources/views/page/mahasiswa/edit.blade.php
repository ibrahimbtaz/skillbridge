@extends('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Mahasiswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #5A67D8; --primary-dark: #4C51BF;
            --secondary: #4A5568; --background: #F7FAFC;
            --card-bg: #FFFFFF; --border: #E2E8F0;
            --error: #E53E3E;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: var(--background); color: var(--secondary);
            line-height: 1.6; padding-bottom: 60px;
        }
        /* Header Bar */
        .header {
            background: var(--primary); color: white;
            padding: 25px 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .header-content {
            max-width: 900px; margin: 0 auto; display: flex;
            justify-content: space-between; align-items: center;
        }
        .header h1 { font-size: 24px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .back-btn {
            padding: 8px 15px; background: rgba(255, 255, 255, 0.2);
            color: white; text-decoration: none; border-radius: 6px;
            font-size: 14px; transition: all 0.3s;
        }
        .back-btn:hover { background: rgba(255, 255, 255, 0.3); }

        /* Container & Card */
        .container { max-width: 900px; margin: 0 auto; padding: 0 20px; }
        .card {
            background: var(--card-bg); border-radius: 10px;
            padding: 30px; box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px; border: 1px solid var(--border);
        }
        .card-header {
            margin-bottom: 25px; padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }
        .card-title {
            font-size: 18px; font-weight: 600; color: var(--secondary);
            display: flex; align-items: center; gap: 8px;
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
            display: block; font-weight: 600; margin-bottom: 6px;
            color: var(--secondary); font-size: 14px;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%; padding: 10px 15px; border: 1px solid var(--border);
            border-radius: 6px; font-size: 15px; font-family: inherit;
            color: #2D3748; transition: all 0.2s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none; border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(90, 103, 216, 0.2);
        }
        .form-textarea { min-height: 100px; resize: vertical; }

        /* Dynamic List Styling */
        .dynamic-list { margin-top: 15px; }
        .dynamic-item {
            display: flex; gap: 10px; margin-bottom: 10px;
            align-items: center;
        }
        .dynamic-item-group {
            border: 1px dashed var(--border);
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .dynamic-item-group .form-row { margin-bottom: 0; }
        .dynamic-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .dynamic-item-title { font-weight: 600; }

        .btn-remove {
            padding: 8px 12px; background: #FFEDED; color: var(--error);
            border: 1px solid #FC8181; border-radius: 6px;
            cursor: pointer; transition: all 0.2s; font-size: 13px;
        }
        .btn-remove:hover { background: #FC8181; color: white; }

        .btn-add {
            padding: 10px 20px; background: #EDF2F7; color: var(--secondary);
            border: 1px dashed var(--border); border-radius: 6px;
            cursor: pointer; transition: all 0.2s; font-size: 14px;
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 10px;
        }
        .btn-add:hover { background: #E2E8F0; }

        /* Form Actions */
        .form-actions {
            display: flex; gap: 12px; justify-content: flex-end;
            margin-top: 30px; padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        .btn {
            padding: 12px 25px; border: none; border-radius: 6px;
            font-size: 15px; font-weight: 600; cursor: pointer;
            transition: all 0.3s;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }

    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1><i class="fas fa-user-edit"></i> Edit Profil Mahasiswa</h1>
            <a href="profil_mahasiswa.html" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Profil
            </a>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="" id="editProfileForm">
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-id-card"></i> Biodata</h2>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-input" value="Ahmad Syahputra">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" value="ahmad.syahputra@email.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Foto Profil (URL)</label>
                        <input type="text" name="photo_url" class="form-input" placeholder="https://... (link ke foto)">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Bio Singkat</label>
                    <textarea name="bio" class="form-textarea" placeholder="Tulis bio singkat Anda...">Full Stack Developer dengan pengalaman 5 tahun...</textarea>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-graduation-cap"></i> Riwayat Pendidikan</h2>
                </div>
                
                <div id="educationList" class="dynamic-list">
                    <div class="dynamic-item-group">
                        <div class="dynamic-item-header">
                            <span class="dynamic-item-title">Item 1</span>
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Institusi</label>
                            <input type="text" name="edu_institution[]" class="form-input" value="Universitas Muria Kudus">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Jenjang</label>
                                <input type="text" name="edu_degree[]" class="form-input" value="S1 Teknik Informatika">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tahun (Contoh: 2015 - 2019)</label>
                                <input type="text" name="edu_years[]" class="form-input" value="2015 - 2019">
                            </div>
                        </div>
                    </div>
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
                    <div class="dynamic-item-group">
                        <div class="dynamic-item-header">
                            <span class="dynamic-item-title">Item 1</span>
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Posisi/Jabatan</label>
                            <input type="text" name="exp_title[]" class="form-input" value="Senior Full Stack Developer">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Perusahaan/Organisasi</label>
                                <input type="text" name="exp_company[]" class="form-input" value="PT Tech Innovation">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Waktu (Contoh: Jan 2022 - Sekarang)</label>
                                <input type="text" name="exp_dates[]" class="form-input" value="Jan 2022 - Sekarang">
                            </div>
                        </div>
                    </div>
                    <div class="dynamic-item-group">
                        <div class="dynamic-item-header">
                            <span class="dynamic-item-title">Item 2</span>
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Posisi/Jabatan</label>
                            <input type="text" name="exp_title[]" class="form-input" value="Full Stack Developer">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Perusahaan/Organisasi</label>
                                <input type="text" name="exp_company[]" class="form-input" value="CV Digital Solutions">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Waktu (Contoh: Mar 2020 - Des 2021)</label>
                                <input type="text" name="exp_dates[]" class="form-input" value="Mar 2020 - Des 2021">
                            </div>
                        </div>
                    </div>
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
                    <div class="dynamic-item">
                        <input type="text" name="skills[]" class="form-input" value="JavaScript">
                        <button type="button" class="btn-remove" onclick="removeItem(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="dynamic-item">
                        <input type="text" name="skills[]" class="form-input" value="React">
                        <button type="button" class="btn-remove" onclick="removeItem(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="dynamic-item">
                        <input type="text" name="skills[]" class="form-input" value="Node.js">
                        <button type="button" class="btn-remove" onclick="removeItem(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <button type="button" class="btn-add" onclick="addSkill()">
                    <i class="fas fa-plus"></i> Tambah Skill
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

        // Update judul saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', () => {
            updateItemTitles(document.getElementById('educationList'));
            updateItemTitles(document.getElementById('experienceList'));
        });
    </script>
</body>
</html>
@endsection