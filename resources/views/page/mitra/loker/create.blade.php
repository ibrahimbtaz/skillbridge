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
        <form method="POST" action="{{ route('mitra.loker.store') }}" id="jobForm">
            @csrf
            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-info-circle"></i> Informasi Utama</h2>
                    <p class="form-hint">Isi detail dasar lowongan pekerjaan.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Judul Posisi <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control"
                           placeholder="Contoh: Frontend Developer"
                           value="{{ old('title') }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Lokasi <span class="required">*</span></label>
                        <input type="text" name="location" class="form-control"
                        placeholder="Contoh: Jakarta Selatan"
                        value="{{ old('location') }}" required>
                        @error('location')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Kerja <span class="required">*</span></label>
                        <select name="jenis_kerja" class="form-control" required>
                            <option value="">Pilih Jenis</option>
                            <option value="fulltime" {{ old('jenis_kerja') === 'fulltime' ? 'selected' : '' }}>Full Time</option>
                            <option value="parttime" {{ old('jenis_kerja') === 'parttime' ? 'selected' : '' }}>Part Time</option>
                            <option value="contract" {{ old('jenis_kerja') === 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="freelance" {{ old('jenis_kerja') === 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="internship" {{ old('jenis_kerja') === 'internship' ? 'selected' : '' }}>Internship</option>
                        </select>
                        @error('jenis_kerja')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tipe Pekerjaan <span class="required">*</span></label>
                        <select name="tipe_kerja" class="form-control" required>
                            <option value="">Pilih Tipe</option>
                            <option value="onsite" {{ old('tipe_kerja') === 'onsite' ? 'selected' : '' }}>Onsite</option>
                            <option value="remote" {{ old('tipe_kerja') === 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="hybrid" {{ old('tipe_kerja') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('tipe_kerja')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Gaji Minimum (Rp) <span class="required">*</span></label>
                        <input type="number" name="salary_min" class="form-control"
                               placeholder="5000000" min="0" step="100000"
                               value="{{ old('salary_min') }}" required>
                        @error('salary_min')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Gaji Maksimum (Rp) <span class="required">*</span></label>
                        <input type="number" name="salary_max" class="form-control"
                               placeholder="10000000" min="0" step="100000"
                               value="{{ old('salary_max') }}" required>
                        @error('salary_max')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deadline Lamaran <span class="required">*</span></label>
                    <input type="date" name="deadline_date" class="form-control"
                           value="{{ old('deadline_date') }}"
                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    @error('deadline_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-file-alt"></i> Deskripsi dan Detail Posisi</h2>
                    <p class="form-hint">Lengkapi detail posisi agar kandidat mendapatkan informasi terbaik.</p>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label class="form-label">Deskripsi Pekerjaan <span class="required">*</span></label>
                    <textarea name="description" class="form-control form-textarea"
                              placeholder="Tuliskan ringkasan mengenai posisi ini..."
                              rows="6" required>{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggung Jawab Pekerjaan</label>
                    <div id="responsibilitiesList" class="dynamic-list">
                        @if(old('responsibilities'))
                            @foreach(old('responsibilities') as $resp)
                                <div class="dynamic-item">
                                    <input type="text" name="responsibilities[]" class="form-control"
                                           value="{{ $resp }}" placeholder="Masukkan tanggung jawab">
                                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="dynamic-item">
                                <input type="text" name="responsibilities[]" class="form-control"
                                       placeholder="Contoh: Mengembangkan fitur backend sesuai spesifikasi">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn-outline" onclick="addResponsibility()">
                        <i class="fas fa-plus"></i> Tambah Tanggung Jawab
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Kualifikasi Utama</label>
                    <div id="requirementsList" class="dynamic-list">
                        @if(old('requirements'))
                            @foreach(old('requirements') as $req)
                                <div class="dynamic-item">
                                    <input type="text" name="requirements[]" class="form-control"
                                           value="{{ $req }}" placeholder="Masukkan kualifikasi">
                                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="dynamic-item">
                                <input type="text" name="requirements[]" class="form-control"
                                       placeholder="Contoh: Menguasai framework tertentu">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn-outline" onclick="addRequirement()">
                        <i class="fas fa-plus"></i> Tambah Kualifikasi
                    </button>
                </div>

                <div class="form-group">
                    <label class="form-label">Benefit & Fasilitas</label>
                    <div id="benefitsList" class="dynamic-list">
                        @if(old('benefits'))
                            @foreach(old('benefits') as $benefit)
                                <div class="dynamic-item">
                                    <input type="text" name="benefits[]" class="form-control"
                                           value="{{ $benefit }}" placeholder="Masukkan benefit">
                                    <button type="button" class="btn-remove" onclick="removeItem(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="dynamic-item">
                                <input type="text" name="benefits[]" class="form-control"
                                       placeholder="Contoh: Tunjangan makan dan transportasi">
                                <button type="button" class="btn-remove" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn-outline" onclick="addBenefit()">
                        <i class="fas fa-plus"></i> Tambah Benefit
                    </button>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('mitra.loker.kelola') }}" class="btn btn-secondary">
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
    addItem('responsibilitiesList', 'responsibilities', 'Tambahkan tanggung jawab baru');
}

function addRequirement() {
    addItem('requirementsList', 'requirements', 'Tambahkan kualifikasi baru');
}

function addBenefit() {
    addItem('benefitsList', 'benefits', 'Tambahkan benefit baru');
}

function removeItem(button) {
    const item = button.parentElement;
    item.remove();
}

document.getElementById('jobForm').addEventListener('submit', function (event) {
    const minField = document.querySelector('input[name="salary_min"]');
    const maxField = document.querySelector('input[name="salary_max"]');
    if (minField && maxField) {
        const min = parseInt(minField.value, 10);
        const max = parseInt(maxField.value, 10);
        if (!Number.isNaN(min) && !Number.isNaN(max) && max < min) {
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

<style>
.text-danger { color: var(--red); font-size: 12px; margin-top: 4px; }
</style>
@endsection
