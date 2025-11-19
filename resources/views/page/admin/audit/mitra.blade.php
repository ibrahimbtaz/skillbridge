@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-handshake"></i> Audit & Verifikasi Mitra
    </h1>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Mitra</div>
            <div class="value">87</div>
        </div>
        <div class="stat-card">
            <div class="label">Pending Verifikasi</div>
            <div class="value" style="color: #f59e0b;">14</div>
        </div>
        <div class="stat-card">
            <div class="label">Terverifikasi</div>
            <div class="value" style="color: var(--green);">68</div>
        </div>
        <div class="stat-card">
            <div class="label">Ditolak</div>
            <div class="value" style="color: var(--red);">5</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Mitra
        </h3>
        <form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Mitra
                    </label>
                    <input type="text" placeholder="Nama perusahaan..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status Verifikasi
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending Verifikasi</option>
                        <option value="verified">Terverifikasi</option>
                        <option value="rejected">Ditolak</option>
                        <option value="suspended">Suspended</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Industri
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Industri</option>
                        <option value="it">Teknologi Informasi</option>
                        <option value="finance">Keuangan</option>
                        <option value="manufacturing">Manufaktur</option>
                        <option value="retail">Retail</option>
                        <option value="education">Pendidikan</option>
                        <option value="healthcare">Kesehatan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Dari Tanggal
                    </label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Sampai Tanggal
                    </label>
                    <input type="date" style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div style="display: flex; align-items: flex-end;">
                    <button type="button" class="btn btn-primary" style="width: 100%;" onclick="alert('Filter diterapkan')">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-list"></i> Daftar Mitra Perusahaan
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="22%">Perusahaan</th>
                        <th width="15%">Industri</th>
                        <th width="12%">Lokasi</th>
                        <th width="10%">Lowongan</th>
                        <th width="12%">Tanggal Daftar</th>
                        <th width="12%">Status</th>
                        <th width="12%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb; flex-shrink: 0;">TM</div>
                                <div>
                                    <div style="font-weight: 600;">PT Teknologi Maju</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> hr@teknomaju.com
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-laptop-code"></i> IT Consultant
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Jakarta Selatan</td>
                        <td><i class="fas fa-briefcase"></i> 12 Aktif</td>
                        <td><i class="far fa-calendar"></i> 15 Jan 2025</td>
                        <td>
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(1); return false;" title="Review Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveMitra(1); return false;" title="Verifikasi">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectMitra(1); return false;" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #dcfce7; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #16a34a; flex-shrink: 0;">CD</div>
                                <div>
                                    <div style="font-weight: 600;">CV Digital Kreatif</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> info@digitalkreatif.com
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-palette"></i> Agency
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Bandung</td>
                        <td><i class="fas fa-briefcase"></i> 8 Aktif</td>
                        <td><i class="far fa-calendar"></i> 18 Jan 2025</td>
                        <td>
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(2); return false;" title="Review Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveMitra(2); return false;" title="Verifikasi">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectMitra(2); return false;" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #e0e7ff; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #4338ca; flex-shrink: 0;">SI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Solusi Indonesia</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> recruitment@solusiid.com
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-code"></i> Software House
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Surabaya</td>
                        <td><i class="fas fa-briefcase"></i> 15 Aktif</td>
                        <td><i class="far fa-calendar"></i> 10 Feb 2025</td>
                        <td>
                            <span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(3); return false;" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editMitra(3); return false;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #92400e; flex-shrink: 0;">BF</div>
                                <div>
                                    <div style="font-weight: 600;">PT Bank Finansia</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> hrd@bankfinansia.co.id
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-university"></i> Keuangan
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Jakarta Pusat</td>
                        <td><i class="fas fa-briefcase"></i> 20 Aktif</td>
                        <td><i class="far fa-calendar"></i> 05 Jan 2025</td>
                        <td>
                            <span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-check-circle"></i> Verified
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(4); return false;" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editMitra(4); return false;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #fee2e2; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #dc2626; flex-shrink: 0;">MI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Media Indonesia</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> contact@mediaindo.com
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-newspaper"></i> Media
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Jakarta Barat</td>
                        <td><i class="fas fa-briefcase"></i> 0 Aktif</td>
                        <td><i class="far fa-calendar"></i> 12 Nov 2024</td>
                        <td>
                            <span style="background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-times-circle"></i> Rejected
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(5); return false;" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 45px; height: 45px; background: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb; flex-shrink: 0;">GI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Global Inovasi</div>
                                    <div style="font-size: 12px; color: var(--text-light);">
                                        <i class="fas fa-envelope" style="font-size: 10px;"></i> career@globalinovasi.com
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background: #fce7f3; color: #be185d; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-rocket"></i> Startup
                            </span>
                        </td>
                        <td><i class="fas fa-map-marker-alt"></i> Yogyakarta</td>
                        <td><i class="fas fa-briefcase"></i> 6 Aktif</td>
                        <td><i class="far fa-calendar"></i> 19 Nov 2025</td>
                        <td>
                            <span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewMitra(6); return false;" title="Review Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveMitra(6); return false;" title="Verifikasi">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectMitra(6); return false;" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function reviewMitra(id) {
        alert('Review Detail Mitra ID: ' + id + '\n\nInformasi lengkap mitra:\n- Profil perusahaan\n- Dokumen verifikasi\n- Riwayat lowongan\n- Rating & review');
    }

    function approveMitra(id) {
        if (confirm('Apakah Anda yakin ingin memverifikasi mitra ini?\n\nMitra akan mendapat akses penuh untuk posting lowongan.')) {
            alert('Mitra ID: ' + id + ' telah diverifikasi!\n\nNotifikasi email akan dikirim ke perusahaan.');
            // Di sini tambahkan logic untuk approve
            location.reload();
        }
    }

    function rejectMitra(id) {
        const reason = prompt('Masukkan alasan penolakan verifikasi:\n\n(Alasan akan dikirim via email ke perusahaan)');
        if (reason && reason.trim() !== '') {
            alert('Mitra ID: ' + id + ' ditolak.\n\nAlasan: ' + reason + '\n\nNotifikasi penolakan akan dikirim.');
            // Di sini tambahkan logic untuk reject
            location.reload();
        } else if (reason !== null) {
            alert('Alasan penolakan tidak boleh kosong!');
        }
    }

    function editMitra(id) {
        alert('Edit Data Mitra ID: ' + id + '\n\nForm edit mitra akan ditampilkan.');
    }
</script>
@endsection
