@extends('layout.dashboard.main')

@section('content')
<style>
.page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.page-header .page-title { margin-bottom: 0; }
.btn-secondary { background: #edf2f7; color: var(--secondary); border: 1px solid var(--border); }
.btn-secondary:hover { background: #e2e8f0; }
.btn-danger { background: var(--red); color: #fff; border: none; }
.btn-danger:hover { background: #c53030; }
.form-section + .form-section { margin-top: 24px; }
.form-section .card-header { border-bottom: none; padding-bottom: 0; }
.form-grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label { font-weight: 600; color: var(--text-dark); font-size: 14px; }
.form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 6px; font-size: 15px; color: var(--secondary); transition: border-color 0.2s, box-shadow 0.2s; }
.form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(90, 103, 216, 0.2); }
.form-textarea { min-height: 120px; resize: vertical; }
.form-hint { font-size: 12px; color: var(--text-light); }
.dynamic-list { display: flex; flex-direction: column; gap: 10px; }
.dynamic-item { display: flex; gap: 10px; align-items: center; }
.dynamic-item .form-control { flex: 1; }
.btn-outline { padding: 10px 16px; border: 1px dashed var(--border); border-radius: 6px; background: #f8fafc; color: var(--secondary); font-weight: 600; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; transition: background 0.2s, border-color 0.2s; }
.btn-outline:hover { background: #e2e8f0; border-color: #cbd5e0; }
.btn-remove { padding: 8px 12px; border-radius: 6px; border: 1px solid #fc8181; background: #ffeded; color: var(--red); cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: background 0.2s, color 0.2s; }
.btn-remove:hover { background: #fc8181; color: #fff; }
.form-actions { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border); flex-wrap: wrap; }
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .form-actions { flex-direction: column; align-items: stretch; }
    .form-actions .btn { width: 100%; justify-content: center; }
}
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h1 class="page-title">Edit Lowongan</h1>
        <a href="{{ route('mitra.loker.kelola') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="content-card">
        <form method="POST" action="{{ route('mitra.loker.update', $loker->id) }}" id="editJobForm">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-info-circle"></i> Informasi Utama</h2>
                    <p class="form-hint">Perbarui detail dasar sebelum menyimpan perubahan.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Judul Posisi</label>
                    <input type="text" name="title" class="form-control" value="{{ $loker->title }}">
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" value="{{ $loker->lokasi }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Pekerjaan</label>
                        <select name="tipe_kerja" class="form-control">
                            <option value="Full Time" {{ $loker->tipe_kerja === 'Full Time' ? 'selected' : '' }}>Full Time</option>
                            <option value="Part Time" {{ $loker->tipe_kerja === 'Part Time' ? 'selected' : '' }}>Part Time</option>
                            <option value="Contract" {{ $loker->tipe_kerja === 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ $loker->tipe_kerja === 'Freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="Internship" {{ $loker->tipe_kerja === 'Internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Gaji Minimum (Rp)</label>
                        <input type="number" name="gaji_min" class="form-control" value="{{ $loker->gaji_min }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gaji Maksimum (Rp)</label>
                        <input type="number" name="gaji_max" class="form-control" value="{{ $loker->gaji_max }}">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-file-alt"></i> Deskripsi, Kualifikasi, dan Lainnya</h2>
                    <p class="form-hint">Lengkapi detail posisi agar kandidat mendapatkan informasi terbaik.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Deskripsi Pekerjaan</label>
                    <textarea name="description" class="form-control form-textarea" rows="6">{{ $loker->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggung Jawab Pekerjaan</label>
                    <div id="responsibilitiesList" class="dynamic-list">
                        @forelse ($loker->tanggung_jawab ?? [] as $resp)
                            <div class="dynamic-item">
                                <input type="text" name="responsibilities[]" class="form-control" value="{{ $resp }}">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @empty
                            <div class="dynamic-item">
                                <input type="text" name="responsibilities[]" class="form-control" placeholder="Masukkan tanggung jawab">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" class="btn-outline" onclick="addResponsibility()">
                        <i class="fas fa-plus"></i> Tambah Tanggung Jawab
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Kualifikasi</label>
                    <div id="requirementsList" class="dynamic-list">
                        @forelse ($loker->kualifikasi ?? [] as $qual)
                        <div class="dynamic-item">
                            <input type="text" name="requirements[]" class="form-control" value="{{ $qual }}">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @empty
                        <div class="dynamic-item">
                            <input type="text" name="requirements[]" class="form-control" placeholder="Masukkan kualifikasi">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn-outline" onclick="addRequirement()">
                        <i class="fas fa-plus"></i> Tambah Kualifikasi
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Benefit &amp; Fasilitas</label>
                    <div id="benefitsList" class="dynamic-list">
                            @forelse ($loker->benefits ?? [] as $benefit)
                            <div class="dynamic-item">
                                <input type="text" name="benefits[]" class="form-control" value="{{ $benefit }}">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            @empty
                            <div class="dynamic-item">
                                <input type="text" name="benefits[]" class="form-control" placeholder="Contoh: Tunjangan makan dan transportasi">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            @endforelse
                        </div>
                    <button type="button" class="btn-outline" onclick="addBenefit()">
                        <i class="fas fa-plus"></i> Tambah Benefit
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <a href="#" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                    <i class="fas fa-trash"></i>
                    Hapus Lowongan
                </a>
                <button type="submit" class="btn btn-primary" id="saveBtn">
                    <i class="fas fa-check"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function addItem(listId, name, placeholder) {
    const list = document.getElementById(listId);
    const wrapper = document.createElement('div');
    wrapper.className = 'dynamic-item';
    wrapper.innerHTML = `
        <input type="text" name="${name}[]" class="form-control" placeholder="${placeholder}">
        <button type="button" class="btn-remove" onclick="removeItem(this)">
            <i class="fas fa-trash"></i>
        </button>
    `;
    list.appendChild(wrapper);
}

function addResponsibility() {
    addItem('responsibilitiesList', 'responsibilities', 'Tambahkan tanggung jawab baru');
}

function addRequirement() {
    addItem('requirementsList', 'requirements', 'Tambahkan kualifikasi baru');
}

function removeItem(button) {
    const item = button.parentElement;
    item.remove();
}

document.getElementById('editJobForm').addEventListener('submit', function (event) {
    const minField = document.querySelector('input[name="gaji_min"]');
    const maxField = document.querySelector('input[name="gaji_max"]');
    if (minField && maxField) {
        const min = parseInt(minField.value, 10);
        const max = parseInt(maxField.value, 10);
        if (!Number.isNaN(min) && !Number.isNaN(max) && max < min) {
            event.preventDefault();
            alert('Gaji maksimum harus lebih besar dari gaji minimum!');
            return;
        }
    }
    const saveBtn = document.getElementById('saveBtn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
});
</script>
@endsection
