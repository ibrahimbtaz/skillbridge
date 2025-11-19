@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-briefcase"></i> Audit Lowongan Kerja
    </h1>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Lowongan</div>
            <div class="value">156</div>
        </div>
        <div class="stat-card">
            <div class="label">Pending Review</div>
            <div class="value" style="color: #f59e0b;">12</div>
        </div>
        <div class="stat-card">
            <div class="label">Approved</div>
            <div class="value" style="color: var(--green);">138</div>
        </div>
        <div class="stat-card">
            <div class="label">Rejected</div>
            <div class="value" style="color: var(--red);">6</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Lowongan
        </h3>
        <form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Lowongan
                    </label>
                    <input type="text" placeholder="Perusahaan atau posisi..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending Review</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Tipe Pekerjaan
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Tipe</option>
                        <option value="fulltime">Full Time</option>
                        <option value="parttime">Part Time</option>
                        <option value="intern">Magang</option>
                        <option value="freelance">Freelance</option>
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
            <i class="fas fa-list"></i> Daftar Lowongan Kerja
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Perusahaan</th>
                        <th width="20%">Posisi</th>
                        <th width="12%">Tipe</th>
                        <th width="12%">Gaji</th>
                        <th width="10%">Lokasi</th>
                        <th width="10%">Status</th>
                        <th width="11%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb;">TM</div>
                                <div>
                                    <div style="font-weight: 600;">PT Teknologi Maju</div>
                                    <div style="font-size: 12px; color: var(--text-light);">IT Consultant</div>
                                </div>
                            </div>
                        </td>
                        <td>Frontend Developer</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Magang</span></td>
                        <td>Rp 2.500.000</td>
                        <td>Jakarta Selatan</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewLoker(1); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveLoker(1); return false;">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectLoker(1); return false;">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #dcfce7; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #16a34a;">CD</div>
                                <div>
                                    <div style="font-weight: 600;">CV Digital Kreatif</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Agency</div>
                                </div>
                            </div>
                        </td>
                        <td>Social Media Admin</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Full Time</span></td>
                        <td>Rp 4.000.000</td>
                        <td>Bandung</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewLoker(2); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveLoker(2); return false;">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectLoker(2); return false;">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #fef3c7; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #92400e;">SI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Solusi Indonesia</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Software House</div>
                                </div>
                            </div>
                        </td>
                        <td>Backend Developer</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Full Time</span></td>
                        <td>Rp 6.000.000</td>
                        <td>Surabaya</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Approved</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewLoker(3); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #fee2e2; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #dc2626;">MI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Media Indonesia</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Media</div>
                                </div>
                            </div>
                        </td>
                        <td>Content Writer</td>
                        <td><span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Part Time</span></td>
                        <td>Rp 3.500.000</td>
                        <td>Jakarta Pusat</td>
                        <td><span style="background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-times-circle"></i> Rejected</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewLoker(4); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #dbeafe; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb;">GI</div>
                                <div>
                                    <div style="font-weight: 600;">PT Global Inovasi</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Startup</div>
                                </div>
                            </div>
                        </td>
                        <td>UI/UX Designer</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Magang</span></td>
                        <td>Rp 2.000.000</td>
                        <td>Yogyakarta</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="reviewLoker(5); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--green); border-color: var(--green);" onclick="approveLoker(5); return false;">
                                    <i class="fas fa-check"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="rejectLoker(5); return false;">
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
    function reviewLoker(id) {
        alert('Review Detail Lowongan ID: ' + id + '\n\nFitur detail review akan ditambahkan.');
    }

    function approveLoker(id) {
        if (confirm('Apakah Anda yakin ingin menyetujui lowongan ini?')) {
            alert('Lowongan ID: ' + id + ' telah disetujui!');
            // Di sini tambahkan logic untuk update status
        }
    }

    function rejectLoker(id) {
        const reason = prompt('Masukkan alasan penolakan:');
        if (reason) {
            alert('Lowongan ID: ' + id + ' ditolak.\nAlasan: ' + reason);
            // Di sini tambahkan logic untuk update status
        }
    }
</script>
@endsection
