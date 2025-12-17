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
                        <div class="value">{{$totalPelamar}}</div>
                        <div class="label">Total Pelamar</div>
                    </div>
                    <div class="stat-card">
                        <div class="value">{{$unreadNotifications}}</div>
                        <div class="label">Pesan Belum Dibaca</div>
                    </div>
                    <div class="stat-card">
                        <div class="value">{{$pelamarMingguIni}}</div>
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
                                @forelse($pelamarTerbaru as $pelamar)
                                <tr>
                                    <td>{{ $pelamar->nama_mahasiswa }}</td>
                                    <td>{{ $pelamar->posisi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pelamar->tanggal_melamar)->format('d M Y') }}</td>
                                    <td>
                                        @switch($pelamar->status)
                                            @case('pending')
                                                <span class="badge badge-warning">Baru Masuk</span>
                                                @break
                                            @case('reviewed')
                                                <span class="badge badge-info">Ditinjau</span>
                                                @break
                                            @case('interview')
                                                <span class="badge badge-primary">Interview</span>
                                                @break
                                            @case('accepted')
                                                <span class="badge badge-success">Diterima</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge badge-danger">Ditolak</span>
                                                @break
                                            @default
                                                <span class="badge badge-secondary">{{ $pelamar->status }}</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('mitra.pelamar.index') }}" class="btn-icon view" title="Lihat Detail">
                                            <i class="fas fa-eye"></i> Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pelamar</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
@endsection
