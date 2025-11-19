<html lang="id"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Pelatihan - Skill Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    
        
        .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 12px 20px;
            margin: 3px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 12px;
        }
        
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            font-weight: 600;
        }
        
        .main-content {
             margin-left: 0; /* Ubah menjadi 0 agar full screen */
             padding: 30px;
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .stats-card .icon {
            font-size: 2.5rem;
            opacity: 0.2;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .filter-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
        }
        
        .table-hover tbody tr {
            transition: all 0.3s;
        }
        
        .table-hover tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
        }
        
        .badge {
            padding: 6px 12px;
            font-weight: 500;
            border-radius: 6px;
        }
        
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
  

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="fas fa-clipboard-check text-primary"></i> Audit Log Pelatihan</h2>
                <p class="text-muted mb-0">Kelola dan pantau semua aktivitas pelatihan</p>
            </div>
            <div>
                <button class="btn btn-success me-2" onclick="alert('Export CSV')">
                    <i class="fas fa-download"></i> Export CSV
                </button>
                <button class="btn btn-info" onclick="alert('Lihat Statistik')">
                    <i class="fas fa-chart-bar"></i> Statistik
                </button>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card position-relative overflow-hidden">
                    <i class="fas fa-clipboard-list icon position-absolute" style="right: 10px; top: 10px;"></i>
                    <h6 class="text-muted mb-2">Total Audit</h6>
                    <h3 class="mb-0">248</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card position-relative overflow-hidden">
                    <i class="fas fa-clock icon position-absolute text-warning" style="right: 10px; top: 10px;"></i>
                    <h6 class="text-muted mb-2">Pending</h6>
                    <h3 class="mb-0 text-warning">12</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card position-relative overflow-hidden">
                    <i class="fas fa-check-circle icon position-absolute text-success" style="right: 10px; top: 10px;"></i>
                    <h6 class="text-muted mb-2">Approved</h6>
                    <h3 class="mb-0 text-success">230</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stats-card position-relative overflow-hidden">
                    <i class="fas fa-times-circle icon position-absolute text-danger" style="right: 10px; top: 10px;"></i>
                    <h6 class="text-muted mb-2">Rejected</h6>
                    <h3 class="mb-0 text-danger">6</h3>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-card mb-4">
            <form>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-search"></i> Cari Pelatihan</label>
                        <input type="text" class="form-control" placeholder="Masukkan judul pelatihan...">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label"><i class="fas fa-filter"></i> Action</label>
                        <select class="form-select">
                            <option value="">Semua Action</option>
                            <option value="created">Created</option>
                            <option value="updated">Updated</option>
                            <option value="deleted">Deleted</option>
                            <option value="published">Published</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label"><i class="fas fa-calendar"></i> Dari Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label"><i class="fas fa-calendar"></i> Sampai</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100" onclick="alert('Filter diterapkan')">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="card">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Audit Log</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="25%">Pelatihan</th>
                                <th width="15%">Admin</th>
                                <th width="10%">Action</th>
                                <th width="10%">Status</th>
                                <th width="15%">Tanggal</th>
                                <th width="12%">IP Address</th>
                                <th width="8%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>#1</strong></td>
                                <td><strong>Web Development Fundamental</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Surya</td>
                                <td><span class="badge bg-success"><i class="fas fa-plus"></i> Created</span></td>
                                <td><span class="badge bg-success"><i class="fas fa-check-circle"></i> Approved</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 10:30</small></td>
                                <td><code class="small">192.168.1.1</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(1)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#2</strong></td>
                                <td><strong>Laravel untuk Pemula</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Anton</td>
                                <td><span class="badge bg-primary"><i class="fas fa-edit"></i> Updated</span></td>
                                <td><span class="badge bg-success"><i class="fas fa-check-circle"></i> Approved</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 11:45</small></td>
                                <td><code class="small">192.168.1.2</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(2)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#3</strong></td>
                                <td><strong>Mobile App Development</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Faiz</td>
                                <td><span class="badge bg-info"><i class="fas fa-globe"></i> Published</span></td>
                                <td><span class="badge bg-warning"><i class="fas fa-clock"></i> Pending</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 13:20</small></td>
                                <td><code class="small">192.168.1.3</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(3)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#4</strong></td>
                                <td><strong>UI/UX Design Basics</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Shofyan</td>
                                <td><span class="badge bg-warning"><i class="fas fa-check"></i> Reviewed</span></td>
                                <td><span class="badge bg-success"><i class="fas fa-check-circle"></i> Approved</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 14:15</small></td>
                                <td><code class="small">192.168.1.4</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(4)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#5</strong></td>
                                <td><strong>Database Management</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Surya</td>
                                <td><span class="badge bg-primary"><i class="fas fa-edit"></i> Updated</span></td>
                                <td><span class="badge bg-danger"><i class="fas fa-times-circle"></i> Rejected</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 15:30</small></td>
                                <td><code class="small">192.168.1.1</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(5)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>#6</strong></td>
                                <td><strong>React JS Advanced</strong></td>
                                <td><i class="fas fa-user-shield text-primary"></i> Admin Amin</td>
                                <td><span class="badge bg-danger"><i class="fas fa-trash"></i> Deleted</span></td>
                                <td><span class="badge bg-success"><i class="fas fa-check-circle"></i> Approved</span></td>
                                <td><small><i class="far fa-clock"></i> 14 Nov 2024, 16:00</small></td>
                                <td><code class="small">192.168.1.5</code></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" onclick="showDetail(6)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-info-circle"></i> Detail Audit Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Informasi Umum</h6>
                            <table class="table table-sm">
                                <tbody><tr><td width="120"><strong>ID Audit:</strong></td><td>#1</td></tr>
                                <tr><td><strong>Pelatihan:</strong></td><td>Web Development Fundamental</td></tr>
                                <tr><td><strong>Admin:</strong></td><td>Admin Surya</td></tr>
                                <tr><td><strong>Action:</strong></td><td><span class="badge bg-success">Created</span></td></tr>
                                <tr><td><strong>Status:</strong></td><td><span class="badge bg-success">Approved</span></td></tr>
                            </tbody></table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Detail Teknis</h6>
                            <table class="table table-sm">
                                <tbody><tr><td width="120"><strong>Tanggal:</strong></td><td>14 Nov 2024, 10:30</td></tr>
                                <tr><td><strong>IP Address:</strong></td><td><code>192.168.1.1</code></td></tr>
                                <tr><td><strong>Notes:</strong></td><td>Pelatihan baru ditambahkan</td></tr>
                            </tbody></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showDetail(id) {
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        }
    </script>

</body></html>