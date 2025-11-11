@extends('layout.dashboard.main')

@section('content')
<style>
.page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.page-header .page-title { margin-bottom: 0; }
.btn-secondary { background: #edf2f7; color: var(--secondary); border: 1px solid var(--border); }
.btn-secondary:hover { background: #e2e8f0; }
.form-section + .form-section { margin-top: 24px; }
.form-section .card-header { border-bottom: none; padding-bottom: 0; }
.form-grid { display: grid; gap: 18px; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label { font-weight: 600; color: var(--text-dark); font-size: 14px; }
.required { color: var(--red); }
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
.form-actions { display: flex; justify-content: flex-end; gap: 12px; margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border); flex-wrap: wrap; }
@media (max-width: 768px) {
    .page-header { flex-direction: column; align-items: flex-start; gap: 12px; }
    .form-actions { justify-content: stretch; }
    .form-actions .btn { flex: 1 0 100%; justify-content: center; }
}
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h1 class="page-title">Tambah Lowongan</h1>
        <a href="{{ route('mitra.loker.kelola') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="content-card">
        <form method="POST" action="" id="jobForm">
            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-map-marker-alt"></i> Informasi Utama Pekerjaan</h2>
                    <p class="form-hint">Isi detail lokasi, tipe kerja, dan rentang gaji.</p>
                </div>

                <div class="form-grid" style="margin-top: 20px;">
                    <div class="form-group">
                        <label class="form-label">Lokasi <span class="required">*</span></label>
                        <input type="text" name="location" class="form-control" placeholder="Remote / Jakarta Selatan" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Pekerjaan <span class="required">*</span></label>
                        <select name="job_type" class="form-control" required>
                            <option value="">Pilih Tipe</option>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                            <option value="Contract">Contract</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Internship">Internship</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Gaji Minimum (Rp) <span class="required">*</span></label>
                        <input type="number" name="salary_min" class="form-control" placeholder="5000000" min="0" step="100000" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gaji Maksimum (Rp) <span class="required">*</span></label>
                        <input type="number" name="salary_max" class="form-control" placeholder="10000000" min="0" step="100000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deadline Lamaran <span class="required">*</span></label>
                    <input type="date" name="deadline_date" class="form-control" required>
                </div>
            </div>

            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-file-alt"></i> Deskripsi dan Detail Posisi</h2>
                    <p class="form-hint">Cantumkan deskripsi pekerjaan, tanggung jawab, dan benefit.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Deskripsi Pekerjaan <span class="required">*</span></label>
                    <textarea name="description" class="form-control form-textarea" placeholder="Tuliskan ringkasan mengenai posisi ini..." rows="6" required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggung Jawab Pekerjaan</label>
                    <div id="responsibilitiesList" class="dynamic-list">
                        <div class="dynamic-item">
                            <input type="text" name="responsibilities[]" class="form-control" placeholder="Contoh: Mengembangkan fitur backend sesuai spesifikasi">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-outline" onclick="addResponsibility()">
                        <i class="fas fa-plus"></i> Tambah Tanggung Jawab
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Kualifikasi Utama</label>
                    <div id="requirementsList" class="dynamic-list">
                        <div class="dynamic-item">
                            <input type="text" name="requirements[]" class="form-control" placeholder="Contoh: Menguasai framework tertentu">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-outline" onclick="addRequirement()">
                        <i class="fas fa-plus"></i> Tambah Kualifikasi
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Benefit &amp; Fasilitas</label>
                    <div id="benefitsList" class="dynamic-list">
                        <div class="dynamic-item">
                            <input type="text" name="benefits[]" class="form-control" placeholder="Contoh: Tunjangan makan dan transportasi">
                            <button type="button" class="btn-remove" onclick="removeItem(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn-outline" onclick="addBenefit()">
                        <i class="fas fa-plus"></i> Tambah Benefit
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <a href="kelolalowongan.html" class="btn btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-check"></i>
                    Simpan Lowongan
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
    addItem('responsibilitiesList', 'responsibilities', 'Contoh: Melakukan code review');
}

function addRequirement() {
    addItem('requirementsList', 'requirements', 'Contoh: Menguasai bahasa pemrograman tertentu');
}

function addBenefit() {
    addItem('benefitsList', 'benefits', 'Contoh: Tunjangan kesehatan');
}

function removeItem(button) {
    const item = button.parentElement;
    const list = item.parentElement;
    if (list.children.length > 1) {
        item.remove();
    } else {
        alert('Minimal harus ada 1 item yang diisi.');
    }
}

document.getElementById('jobForm').addEventListener('submit', function (event) {
    const minField = document.querySelector('input[name="salary_min"]');
    const maxField = document.querySelector('input[name="salary_max"]');
    if (minField && maxField) {
        const min = parseInt(minField.value, 10);
        const max = parseInt(maxField.value, 10);
        if (max < min) {
            event.preventDefault();
            alert('Gaji maksimum harus lebih besar dari gaji minimum!');
            return;
        }
    }
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
});
</script>
@endsection
