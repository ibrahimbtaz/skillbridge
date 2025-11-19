@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-clipboard-check"></i> Audit Log Pelatihan
    </h1>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Audit</div>
            <div class="value">248</div>
        </div>
        <div class="stat-card">
            <div class="label">Pending</div>
            <div class="value" style="color: #f59e0b;">12</div>
        </div>
        <div class="stat-card">
            <div class="label">Approved</div>
            <div class="value" style="color: var(--green);">230</div>
        </div>
        <div class="stat-card">
            <div class="label">Rejected</div>
            <div class="value" style="color: var(--red);">6</div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 20px;">
            <i class="fas fa-filter"></i> Filter Audit Log
        </h3>
        <form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pelatihan
                    </label>
                    <input type="text" placeholder="Masukkan judul pelatihan..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Action
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Action</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                        <option value="published">Published</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
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
            <i class="fas fa-list"></i> Daftar Audit Log
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Pelatihan</th>
                        <th width="15%">Admin</th>
                        <th width="10%">Action</th>
                        <th width="10%">Status</th>
                        <th width="15%">Tanggal</th>
                        <th width="12%">IP Address</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>Web Development Fundamental</td>
                        <td><i class="fas fa-user-shield"></i> Admin Surya</td>
                        <td><span style="background: var(--green); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-plus"></i> Created</span></td>
                        <td><span style="background: var(--green); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Approved</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 10:30</td>
                        <td><code>192.168.1.1</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(1); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>Laravel untuk Pemula</td>
                        <td><i class="fas fa-user-shield"></i> Admin Anton</td>
                        <td><span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-edit"></i> Updated</span></td>
                        <td><span style="background: var(--green); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Approved</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 11:45</td>
                        <td><code>192.168.1.2</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(2); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>Mobile App Development</td>
                        <td><i class="fas fa-user-shield"></i> Admin Faiz</td>
                        <td><span style="background: #3b82f6; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-globe"></i> Published</span></td>
                        <td><span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-clock"></i> Pending</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 13:20</td>
                        <td><code>192.168.1.3</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(3); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>UI/UX Design Basics</td>
                        <td><i class="fas fa-user-shield"></i> Admin Shofyan</td>
                        <td><span style="background: #f59e0b; color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check"></i> Reviewed</span></td>
                        <td><span style="background: var(--green); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Approved</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 14:15</td>
                        <td><code>192.168.1.4</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(4); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>Database Management</td>
                        <td><i class="fas fa-user-shield"></i> Admin Surya</td>
                        <td><span style="background: var(--primary); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-edit"></i> Updated</span></td>
                        <td><span style="background: var(--red); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-times-circle"></i> Rejected</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 15:30</td>
                        <td><code>192.168.1.1</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(5); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>React JS Advanced</td>
                        <td><i class="fas fa-user-shield"></i> Admin Amin</td>
                        <td><span style="background: var(--red); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-trash"></i> Deleted</span></td>
                        <td><span style="background: var(--green); color: white; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Approved</span></td>
                        <td><i class="far fa-clock"></i> 14 Nov 2024, 16:00</td>
                        <td><code>192.168.1.5</code></td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="showDetail(6); return false;">
                                    <i class="fas fa-eye"></i>
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
    function showDetail(id) {
        alert('Detail Audit ID: ' + id + '\n\nInformasi detail akan ditampilkan di sini.');
    }
</script>
@endsection
