@extends('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelatihan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #5A67D8; --primary-dark: #4C51BF;
            --secondary: #4A5568; --background: #F7FAFC;
            --card-bg: #FFFFFF; --border: #E2E8F0;
            --error: #E53E3E; --error-light: #FFEDED;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: var(--background); color: var(--secondary);
            line-height: 1.6; padding-bottom: 60px;
        }
        /* Header */
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
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
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
        .form-textarea { min-height: 120px; resize: vertical; }

        /* Dynamic List */
        .dynamic-list { margin-top: 15px; }
        .dynamic-item {
            display: flex; gap: 10px; margin-bottom: 10px;
            align-items: center;
        }
        .dynamic-item input { flex: 1; }

        .btn-remove {
            padding: 8px 12px; background: var(--error-light); color: var(--error);
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
            display: flex; gap: 12px; justify-content: space-between;
            align-items: center; margin-top: 30px;
        }
        .btn {
            padding: 12px 25px; border: none; border-radius: 6px;
            font-size: 15px; font-weight: 600; cursor: pointer;
            transition: all 0.3s; text-decoration: none;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-danger {
            background: var(--error);
            color: white;
            border: none;
        }
        .btn-danger:hover { background: #c53030; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1><i class="fas fa-edit"></i> Edit Pelatihan</h1>
            <a href="dashboard_mitra.html" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="" id="editTrainingForm">

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-info-circle"></i> Informasi Pelatihan</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Pelatihan</label>
                    <input type="text" name="title" class="form-input" value="Full-Stack Web Development Bootcamp">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Instruktur / Perusahaan</label>
                        <input type="text" name="instructor" class="form-input" value="Tech Innovators Academy">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="category" class="form-input" value="Web Development">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">URL Gambar</label>
                    <input type="text" name="image_url" class="form-input" value="https://via.placeholder.com/300x150?text=Gambar+Pelatihan">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Durasi</label>
                        <input type="text" name="duration" class="form-input" value="12 Jam Total">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Level</label>
                        <select name="level" class="form-select">
                            <option value="Pemula">Pemula</option>
                            <option value="Menengah" selected>Menengah</option>
                            <option value="Mahir">Mahir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sertifikat</label>
                        <select name="certificate" class="form-select">
                            <option value="1" selected>Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-file-alt"></i> Deskripsi & Materi</h2>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Pelatihan</label>
                    <textarea name="description" class="form-textarea" rows="5">Pelatihan ini dirancang untuk mengubah Anda menjadi Full-Stack Developer. Anda akan belajar membangun aplikasi web modern dari awal hingga akhir, mencakup teknologi frontend (React) dan backend (Node.js).</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Materi yang Akan Dipelajari</label>
                    <div id="materialsList" class="dynamic-list">
                        <div class="dynamic-item">
                            <input type="text" name="materials[]" class="form-input" value="Setup Lingkungan Development (VS Code, Git, Node.js)">
                            <button type="button" class="btn-remove" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="dynamic-item">
                            <input type="text" name="materials[]" class="form-input" value="Dasar HTML5, CSS3, dan JavaScript ES6+">
                            <button type="button" class="btn-remove" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="dynamic-item">
                            <input type="text" name="materials[]" class="form-input" value="Membangun UI interaktif dengan React.js">
                            <button type="button" class="btn-remove" onclick="removeItem(this)"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <button type="button" class="btn-add" onclick="addItem('materialsList', 'materials[]', 'Materi baru')">
                        <i class="fas fa-plus"></i> Tambah Materi
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <a href="#" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')">
                    <i class="fas fa-trash"></i> Hapus Pelatihan
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi untuk menambahkan item
        function addItem(listId, name, placeholder) {
            const list = document.getElementById(listId);
            const item = document.createElement('div');
            item.className = 'dynamic-item';
            item.innerHTML = `
                <input type="text" name="${name}" class="form-input" placeholder="${placeholder}">
                <button type="button" class="btn-remove" onclick="removeItem(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            list.appendChild(item);
        }

        // Fungsi untuk menghapus item
        function removeItem(button) {
            const item = button.parentElement;
            item.remove();
        }
    </script>
</body>
</html>
@endsection
