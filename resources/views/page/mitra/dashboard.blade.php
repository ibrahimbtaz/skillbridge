@extends('layout.dashboard.main')

@section('content')
<div class="content-wrapper">
                <h1 class="page-title">Dashboard</h1>

                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="value">{{$loker_count}}</div>
                        <div class="label">Lowongan Aktif</div>
                    </div>
                    <div class="stat-card">
                        <div class="value">28</div>
                        <div class="label">Total Pelamar</div>
                    </div>
                    <div class="stat-card">
                        <div class="value">3</div>
                        <div class="label">Pesan Belum Dibaca</div>
                    </div>
                    <div class="stat-card">
                        <div class="value">12</div>
                        <div class="label">Pelamar Baru (Minggu Ini)</div>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-header">
                        <h2 class="card-title">Pelamar Terbaru</h2>
                    </div>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Melamar Untuk Posisi</th>
                                    <th>Tanggal Melamar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ahmad Syahputra</td>
                                    <td>Senior Frontend Developer</td>
                                    <td>10 Nov 2025</td>
                                    <td>Baru Masuk</td>
                                    <td>
                                        <a href="#" class="btn-icon view" title="Lihat Profil">
                                            <i class="fas fa-eye"></i> Lihat Profil
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Budi Santoso</td>
                                    <td>UI/UX Designer</td>
                                    <td>09 Nov 2025</td>
                                    <td>Ditinjau</td>
                                    <td>
                                        <a href="#" class="btn-icon view" title="Lihat Profil">
                                            <i class="fas fa-eye"></i> Lihat Profil
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Siti Nurhaliza</td>
                                    <td>Senior Frontend Developer</td>
                                    <td>09 Nov 2025</td>
                                    <td>Baru Masuk</td>
                                    <td>
                                        <a href="#" class="btn-icon view" title="Lihat Profil">
                                            <i class="fas fa-eye"></i> Lihat Profil
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
@endsection
