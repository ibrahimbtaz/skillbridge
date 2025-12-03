@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title with Back Button -->
    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
        <a href="{{ route('admin.kelola.pelatihan') }}" class="btn btn-secondary" style="display: flex; align-items: center; gap: 8px;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="page-title" style="margin: 0;">
            <i class="fas fa-plus-circle"></i> Tambah Pelatihan Baru
        </h1>
    </div>

    @if($errors->any())
    <div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Terjadi kesalahan:</strong>
        </div>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.kelola.pelatihan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <!-- Left Column -->
            <div>
                <!-- Thumbnail Card -->
                <div class="content-card" style="margin-bottom: 20px;">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-image"></i> Thumbnail
                    </h3>

                    <!-- Thumbnail Preview -->
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Preview Thumbnail
                        </label>
                        <div id="thumbnailPreview" style="width: 100%; aspect-ratio: 16/9; border-radius: 12px; overflow: hidden; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative;">
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: white;" id="placeholderIcon">
                                <i class="fas fa-graduation-cap" style="font-size: 64px;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Thumbnail -->
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Upload Thumbnail
                        </label>
                        <input type="file" name="thumbnail" id="thumbnailInput" accept="image/*"
                            style="width: 100%; padding: 10px; border: 2px dashed var(--border); border-radius: 8px; background: var(--bg); cursor: pointer;"
                            onchange="previewThumbnail(this)">
                        <p style="font-size: 12px; color: var(--text-light); margin-top: 8px;">
                            Format: JPG, PNG, GIF. Maksimal 2MB.
                        </p>
                    </div>
                </div>

                <!-- Rating Card -->
                <div class="content-card" style="margin-bottom: 20px;">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-star"></i> Rating
                    </h3>
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Rating Awal (0-5)
                        </label>
                        <input type="number" name="rating" value="{{ old('rating', 0) }}"
                            step="0.1" min="0" max="5"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 16px;"
                            placeholder="Contoh: 4.5">
                        <p style="font-size: 12px; color: var(--text-light); margin-top: 8px;">
                            Rating awal pelatihan. Bisa diubah nanti sesuai feedback.
                        </p>
                    </div>
                </div>

                <!-- Tags Card -->
                <div class="content-card">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-tags"></i> Tags
                    </h3>
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Tags (pisahkan dengan koma)
                        </label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px;"
                            placeholder="Contoh: Web, Programming, Laravel">
                        <p style="font-size: 12px; color: var(--text-light); margin-top: 8px;">
                            Pisahkan setiap tag dengan koma.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Main Info Card -->
                <div class="content-card" style="margin-bottom: 20px;">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-info-circle"></i> Informasi Pelatihan
                    </h3>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Nama Pelatihan <span style="color: var(--red);">*</span>
                        </label>
                        <input type="text" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}" required
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 16px;"
                            placeholder="Masukkan nama pelatihan">
                    </div>

                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Kategori <span style="color: var(--red);">*</span>
                        </label>
                        <select name="kategori" required
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; background: white;">
                            <option value="">Pilih Kategori</option>
                            <option value="Programming" {{ old('kategori') == 'Programming' ? 'selected' : '' }}>Programming</option>
                            <option value="Design" {{ old('kategori') == 'Design' ? 'selected' : '' }}>Design</option>
                            <option value="Business" {{ old('kategori') == 'Business' ? 'selected' : '' }}>Business</option>
                            <option value="Marketing" {{ old('kategori') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Data Science" {{ old('kategori') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                        </select>
                    </div>
                </div>

                <!-- Description Card -->
                <div class="content-card" style="margin-bottom: 20px;">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-align-left"></i> Deskripsi
                    </h3>
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Deskripsi Pelatihan <span style="color: var(--red);">*</span>
                        </label>
                        <textarea name="deskripsi" required rows="6"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; resize: vertical;"
                            placeholder="Masukkan deskripsi pelatihan">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <!-- Persyaratan Card -->
                <div class="content-card" style="margin-bottom: 20px;">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-clipboard-list"></i> Persyaratan
                    </h3>
                    <div>
                        <label style="display: block; font-size: 12px; color: var(--text-light); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            Persyaratan Peserta (satu per baris)
                        </label>
                        <textarea name="persyaratan" rows="4"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; resize: vertical;"
                            placeholder="Masukkan persyaratan (satu per baris)">{{ old('persyaratan') }}</textarea>
                        <p style="font-size: 12px; color: var(--text-light); margin-top: 8px;">
                            Masukkan setiap persyaratan pada baris baru.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="content-card">
                    <h3 class="card-title" style="margin-bottom: 15px;">
                        <i class="fas fa-save"></i> Simpan Pelatihan
                    </h3>
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">
                            <i class="fas fa-save"></i> Simpan Pelatihan
                        </button>
                        <a href="{{ route('admin.kelola.pelatihan') }}" class="btn btn-secondary" style="flex: 1; text-align: center;">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewThumbnail(input) {
        const preview = document.getElementById('thumbnailPreview');
        const placeholderIcon = document.getElementById('placeholderIcon');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Remove placeholder if exists
                if (placeholderIcon) {
                    placeholderIcon.style.display = 'none';
                }

                // Check if image already exists
                let previewImage = document.getElementById('previewImage');
                if (!previewImage) {
                    previewImage = document.createElement('img');
                    previewImage.id = 'previewImage';
                    previewImage.style.cssText = 'width: 100%; height: 100%; object-fit: cover;';
                    preview.appendChild(previewImage);
                }

                previewImage.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
