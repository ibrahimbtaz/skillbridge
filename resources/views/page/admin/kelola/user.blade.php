@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-users-cog"></i> Manajemen Pengguna
    </h1>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Mahasiswa</div>
            <div class="value">1,240</div>
        </div>
        <div class="stat-card">
            <div class="label">Total Mitra</div>
            <div class="value">87</div>
        </div>
        <div class="stat-card">
            <div class="label">Aktif Bulan Ini</div>
            <div class="value" style="color: var(--green);">856</div>
        </div>
        <div class="stat-card">
            <div class="label">Pending Verifikasi</div>
            <div class="value" style="color: #f59e0b;">14</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Pengguna
        </h3>
        <form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pengguna
                    </label>
                    <input type="text" placeholder="Nama atau email..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Role
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Role</option>
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="mitra">Mitra</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                        <option value="pending">Pending</option>
                        <option value="suspended">Suspended</option>
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-list"></i> Daftar Pengguna
            </h3>
            <button class="btn btn-primary" onclick="addUser()">
                <i class="fas fa-plus"></i> Tambah User
            </button>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="20%">Nama</th>
                        <th width="18%">Email</th>
                        <th width="12%">Role</th>
                        <th width="12%">Status</th>
                        <th width="15%">Bergabung</th>
                        <th width="10%">Aktivitas</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb;">AS</div>
                                <div style="font-weight: 600;">Ahmad Suryadi</div>
                            </div>
                        </td>
                        <td>ahmad.suryadi@student.ac.id</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-user-graduate"></i> Mahasiswa</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td><i class="far fa-calendar"></i> 15 Jan 2025</td>
                        <td><i class="far fa-clock"></i> 2 hari lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(1); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(1); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #16a34a;">SK</div>
                                <div style="font-weight: 600;">Siti Khoiriyah</div>
                            </div>
                        </td>
                        <td>siti.khoiriyah@student.ac.id</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-user-graduate"></i> Mahasiswa</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td><i class="far fa-calendar"></i> 20 Jan 2025</td>
                        <td><i class="far fa-clock"></i> 5 jam lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(2); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(2); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #fef3c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #92400e;">TM</div>
                                <div style="font-weight: 600;">PT Teknologi Maju</div>
                            </div>
                        </td>
                        <td>hr@teknologimaju.com</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-building"></i> Mitra</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td><i class="far fa-calendar"></i> 10 Feb 2025</td>
                        <td><i class="far fa-clock"></i> 1 hari lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(3); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(3); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #e0e7ff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #4338ca;">BW</div>
                                <div style="font-weight: 600;">Budi Wibowo</div>
                            </div>
                        </td>
                        <td>budi.wibowo@student.ac.id</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-user-graduate"></i> Mahasiswa</span></td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td><i class="far fa-calendar"></i> 18 Nov 2025</td>
                        <td><i class="far fa-clock"></i> 1 minggu lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(4); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(4); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #dc2626;">DK</div>
                                <div style="font-weight: 600;">CV Digital Kreatif</div>
                            </div>
                        </td>
                        <td>info@digitalkreatif.com</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-building"></i> Mitra</span></td>
                        <td><span style="background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-ban"></i> Suspended</span></td>
                        <td><i class="far fa-calendar"></i> 05 Nov 2025</td>
                        <td><i class="far fa-clock"></i> 2 minggu lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(5); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(5); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 35px; height: 35px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #2563eb;">RP</div>
                                <div style="font-weight: 600;">Rina Putri</div>
                            </div>
                        </td>
                        <td>rina.putri@student.ac.id</td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-user-graduate"></i> Mahasiswa</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td><i class="far fa-calendar"></i> 22 Jan 2025</td>
                        <td><i class="far fa-clock"></i> 3 jam lalu</td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewUser(6); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editUser(6); return false;">
                                    <i class="fas fa-edit"></i>
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
    function viewUser(id) {
        alert('Lihat Detail User ID: ' + id + '\n\nFitur detail user akan ditampilkan di sini.');
    }

    function editUser(id) {
        alert('Edit User ID: ' + id + '\n\nForm edit user akan ditampilkan.');
    }

    function addUser() {
        alert('Tambah User Baru\n\nForm tambah user akan ditampilkan.');
    }
</script>
@endsection
