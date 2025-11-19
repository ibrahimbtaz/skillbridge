@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-graduation-cap"></i> Kelola Pelatihan
    </h1>

    <!-- Statistics Cards -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="label">Total Pelatihan</div>
            <div class="value">42</div>
        </div>
        <div class="stat-card">
            <div class="label">Aktif</div>
            <div class="value" style="color: var(--green);">35</div>
        </div>
        <div class="stat-card">
            <div class="label">Draft</div>
            <div class="value" style="color: #f59e0b;">5</div>
        </div>
        <div class="stat-card">
            <div class="label">Total Peserta</div>
            <div class="value">1,856</div>
        </div>
    </div>

    <!-- Filter & Add Button Section -->
    <div class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <h3 class="card-title" style="margin: 0;">
                <i class="fas fa-filter"></i> Filter Pelatihan
            </h3>
            <button class="btn btn-primary" onclick="addPelatihan()">
                <i class="fas fa-plus"></i> Tambah Pelatihan
            </button>
        </div>
        <form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Cari Pelatihan
                    </label>
                    <input type="text" placeholder="Judul pelatihan..." style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Kategori
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Kategori</option>
                        <option value="programming">Programming</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="business">Business</option>
                        <option value="softskill">Soft Skill</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Status
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Arsip</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: var(--text-light);">
                        Level
                    </label>
                    <select style="width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 6px; font-size: 14px;">
                        <option value="">Semua Level</option>
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="advanced">Advanced</option>
                    </select>
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
            <i class="fas fa-list"></i> Daftar Pelatihan
        </h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="25%">Judul Pelatihan</th>
                        <th width="12%">Kategori</th>
                        <th width="10%">Level</th>
                        <th width="10%">Durasi</th>
                        <th width="10%">Peserta</th>
                        <th width="10%">Status</th>
                        <th width="10%">Rating</th>
                        <th width="8%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-code"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Web Development Fundamental</div>
                                    <div style="font-size: 12px; color: var(--text-light);">HTML, CSS, JavaScript</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Programming</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Beginner</span></td>
                        <td><i class="far fa-clock"></i> 8 Minggu</td>
                        <td><i class="fas fa-users"></i> 245</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">4.8</span>
                                <span style="color: var(--text-light); font-size: 12px;">(156)</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(1); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(1); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(1); return false;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#2</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-paint-brush"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">UI/UX Design Mastery</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Figma, Adobe XD</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Design</span></td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Intermediate</span></td>
                        <td><i class="far fa-clock"></i> 6 Minggu</td>
                        <td><i class="fas fa-users"></i> 189</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">4.9</span>
                                <span style="color: var(--text-light); font-size: 12px;">(142)</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(2); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(2); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(2); return false;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#3</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Database Management MySQL</div>
                                    <div style="font-size: 12px; color: var(--text-light);">SQL, Database Design</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Programming</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Beginner</span></td>
                        <td><i class="far fa-clock"></i> 4 Minggu</td>
                        <td><i class="fas fa-users"></i> 167</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">4.7</span>
                                <span style="color: var(--text-light); font-size: 12px;">(98)</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(3); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(3); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(3); return false;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#4</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Digital Marketing Strategy</div>
                                    <div style="font-size: 12px; color: var(--text-light);">SEO, Social Media, Ads</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Marketing</span></td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Intermediate</span></td>
                        <td><i class="far fa-clock"></i> 5 Minggu</td>
                        <td><i class="fas fa-users"></i> 203</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">4.6</span>
                                <span style="color: var(--text-light); font-size: 12px;">(112)</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(4); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(4); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(4); return false;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#5</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #4338ca; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Communication & Presentation</div>
                                    <div style="font-size: 12px; color: var(--text-light);">Public Speaking, Leadership</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #fce7f3; color: #be185d; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Soft Skill</span></td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Beginner</span></td>
                        <td><i class="far fa-clock"></i> 3 Minggu</td>
                        <td><i class="fas fa-users"></i> 312</td>
                        <td><span style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-check-circle"></i> Aktif</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">4.9</span>
                                <span style="color: var(--text-light); font-size: 12px;">(203)</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(5); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(5); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(5); return false;">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#6</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; flex-shrink: 0;">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600;">Mobile App Development</div>
                                    <div style="font-size: 12px; color: var(--text-light);">React Native, Flutter</div>
                                </div>
                            </div>
                        </td>
                        <td><span style="background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Programming</span></td>
                        <td><span style="background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 4px; font-size: 12px;">Advanced</span></td>
                        <td><i class="far fa-clock"></i> 10 Minggu</td>
                        <td><i class="fas fa-users"></i> 124</td>
                        <td><span style="background: #fef3c7; color: #92400e; padding: 4px 10px; border-radius: 4px; font-size: 12px;"><i class="fas fa-file"></i> Draft</span></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-star" style="color: #fbbf24; font-size: 12px;"></i>
                                <span style="font-weight: 600;">-</span>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-icon view" onclick="viewPelatihan(6); return false;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn-icon" onclick="editPelatihan(6); return false;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-icon" style="color: var(--red); border-color: var(--red);" onclick="deletePelatihan(6); return false;">
                                    <i class="fas fa-trash"></i>
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
    function viewPelatihan(id) {
        alert('Lihat Detail Pelatihan ID: ' + id + '\n\nFitur detail pelatihan akan ditampilkan.');
    }

    function editPelatihan(id) {
        alert('Edit Pelatihan ID: ' + id + '\n\nForm edit pelatihan akan ditampilkan.');
    }

    function deletePelatihan(id) {
        if (confirm('Apakah Anda yakin ingin menghapus pelatihan ini?')) {
            alert('Pelatihan ID: ' + id + ' telah dihapus!');
            // Di sini tambahkan logic untuk delete
        }
    }

    function addPelatihan() {
        alert('Tambah Pelatihan Baru\n\nForm tambah pelatihan akan ditampilkan.');
    }
</script>
@endsection
