@extends('layout.dashboard.main')

@section('content')
        <main class="main-content">

            <div class="content-wrapper">
                <h1 class="page-title">Dashboard</h1>

                <div class="stat-grid">
                    <div class="stat-card">
                        <div class="stat-icon icon-users"><i class="fas fa-users"></i></div>
                        <div class="stat-info">
                            <div class="value">150</div>
                            <div class="label">Total Mahasiswa</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-partners"><i class="fas fa-handshake"></i></div>
                        <div class="stat-info">
                            <div class="value">25</div>
                            <div class="label">Total Mitra</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-jobs"><i class="fas fa-briefcase"></i></div>
                        <div class="stat-info">
                            <div class="value">40</div>
                            <div class="label">Lowongan Aktif</div>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon icon-pending"><i class="fas fa-hourglass-half"></i></div>
                        <div class="stat-info">
                            <div class="value">5</div>
                            <div class="label">Lowongan Pending</div>
                        </div>
                    </div>
                </div>

                </div>
        </main>
@endsection
