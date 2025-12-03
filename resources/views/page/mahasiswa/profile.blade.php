@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - {{ $mahasiswa->nama }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; color: #333; line-height: 1.6; }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px 0;
            z-index: 100;
        }
        .header-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
        }
        .back-btn {
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            font-weight: 500;
        }
        .back-btn:hover { color: #2563eb; }

        .container { max-width: 1000px; margin: 24px auto; padding: 0 20px; }
        .card { background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 24px; overflow: hidden; }

        /* Profil Header */
        .profile-header {
            display: flex;
            gap: 24px;
            padding: 24px;
            align-items: center;
            flex-wrap: wrap;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e5e7eb;
            flex-shrink: 0;
        }
        .profile-picture-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
        }
        .profile-info {
            flex: 1;
        }
        .profile-info h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .profile-info .job-title {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .profile-info .location {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 12px;
        }
        .profile-stats {
            display: flex;
            gap: 24px;
            margin-top: 12px;
        }
        .stat-item {
            text-align: left;
        }
        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #2563eb;
        }
        .stat-label {
            font-size: 13px;
            color: #6b7280;
        }
        .profile-actions {
            margin-left: auto;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-primary { background: #2563eb; color: white; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-secondary { background: white; color: #2563eb; border: 2px solid #2563eb; }
        .btn-secondary:hover { background: #eff6ff; }

        /* Detail Info Grid */
        .student-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 24px;
            border-top: 1px solid #e5e7eb;
        }
        .detail-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: #4b5563;
        }
        .detail-item i {
            width: 30px;
            text-align: center;
            color: #2563eb;
            font-size: 16px;
        }
        .detail-item .label {
            color: #6b7280;
        }
        .detail-item .value {
            font-weight: 600;
            word-break: break-all;
        }
        .detail-item .value a {
            color: #2563eb;
            text-decoration: none;
        }
        .detail-item .value a:hover {
            text-decoration: underline;
        }

        /* Card Content Sections */
        .card-content {
            padding: 24px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        .about-text, .description {
            color: #4b5563;
            line-height: 1.8;
        }

        .experience-item, .education-item {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .experience-item:last-child, .education-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .item-title {
            font-size: 17px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .item-company {
            color: #2563eb;
            font-size: 15px;
            margin-bottom: 6px;
        }
        .item-date {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .item-description {
            color: #4b5563;
            line-height: 1.7;
        }

        /* Skills */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skill-tag {
            background: #eff6ff;
            color: #2563eb;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #bfdbfe;
        }

        /* Language Items */
        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .language-item:last-child {
            border-bottom: none;
        }
        .language-name {
            font-weight: 600;
            color: #1f2937;
        }
        .language-level {
            color: #6b7280;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            .profile-info h1 {
                font-size: 24px;
            }
            .profile-stats {
                justify-content: center;
                gap: 16px;
            }
            .profile-actions {
                margin-left: 0;
                width: 100%;
                flex-direction: column;
            }
            .btn {
                width: 100%;
                justify-content: center;
            }
            .student-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <a href="{{ route('home') }}" class="back-btn">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="profile-header">
                @if($mahasiswa->foto_profil)
                    <img src="{{ asset('storage/' . $mahasiswa->foto_profil) }}" alt="Profile" class="profile-picture">
                @else
                    <div class="profile-picture-placeholder">{{ strtoupper(substr($mahasiswa->nama, 0, 2)) }}</div>
                @endif
                <div class="profile-info">
                    <h1>{{ $mahasiswa->nama }}</h1>
                    <p class="job-title">{{ $mahasiswa->jurusan ?? 'Mahasiswa' }} - Semester {{ $mahasiswa->semester ?? '-' }}</p>
                    <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $mahasiswa->alamat ?? 'Indonesia' }}</p>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <div class="stat-number">{{ $mahasiswa->total_lamaran ?? 0 }}</div>
                            <div class="stat-label">Lamaran</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $mahasiswa->total_interview ?? 0 }}</div>
                            <div class="stat-label">Interview</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $mahasiswa->total_penawaran ?? 0 }}</div>
                            <div class="stat-label">Penawaran</div>
                        </div>
                    </div>
                </div>
                @if(auth()->check() && auth()->user()->id === $mahasiswa->user_id)
                <div class="profile-actions">
                    <a href="{{route('mahasiswa.edit')}}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                    <a href="{{route('mahasiswa.portofolio')}}" class="btn btn-secondary">
                        <i class="fas fa-download"></i> Unduh CV
                    </a>
                </div>
                @endif
            </div>

            <div class="student-details">
                <div class="detail-item">
                    <i class="fas fa-id-card"></i>
                    <div>
                        <div class="label">NIM</div>
                        <div class="value">{{ $mahasiswa->nim ?? '-' }}</div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:{{ $mahasiswa->user->email }}">{{ $mahasiswa->user->email }}</a></div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <div class="label">No. Telepon</div>
                        <div class="value">{{ $mahasiswa->no_telp ?? '-' }}</div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <div>
                        <div class="label">Tanggal Lahir</div>
                        <div class="value">{{ $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') : '-' }}</div>
                    </div>
                </div>
                @if($mahasiswa->kontak_tambahan && isset($mahasiswa->kontak_tambahan['linkedin']))
                <div class="detail-item">
                    <i class="fab fa-linkedin"></i>
                    <div>
                        <div class="label">LinkedIn</div>
                        <div class="value"><a href="{{ $mahasiswa->kontak_tambahan['linkedin'] }}" target="_blank">Lihat Profil</a></div>
                    </div>
                </div>
                @endif
                @if($mahasiswa->kontak_tambahan && isset($mahasiswa->kontak_tambahan['github']))
                <div class="detail-item">
                    <i class="fab fa-github"></i>
                    <div>
                        <div class="label">GitHub</div>
                        <div class="value"><a href="{{ $mahasiswa->kontak_tambahan['github'] }}" target="_blank">Lihat Profil</a></div>
                    </div>
                </div>
                @endif
                @if($mahasiswa->kontak_tambahan && isset($mahasiswa->kontak_tambahan['portfolio']))
                <div class="detail-item">
                    <i class="fas fa-globe"></i>
                    <div>
                        <div class="label">Portfolio</div>
                        <div class="value"><a href="{{ $mahasiswa->kontak_tambahan['portfolio'] }}" target="_blank">Kunjungi Website</a></div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="card card-content">
            <h2 class="section-title">Tentang Saya</h2>
            <p class="description">
                {{ $mahasiswa->bio ?? 'Belum ada bio. Klik Edit Profil untuk menambahkan informasi tentang diri Anda.' }}
            </p>
        </div>

        <div class="card card-content">
            <h2 class="section-title">Pengalaman Kerja</h2>
            @if($mahasiswa->pengalaman && count($mahasiswa->pengalaman) > 0)
                @foreach($mahasiswa->pengalaman as $exp)
                <div class="experience-item">
                    <div class="item-title">{{ $exp['title'] ?? '' }}</div>
                    <div class="item-company">{{ $exp['company'] ?? '' }}</div>
                    <div class="item-date">
                        <i class="far fa-calendar"></i> {{ $exp['dates'] ?? '' }}
                    </div>
                    @if(isset($exp['description']))
                    <div class="item-description">{{ $exp['description'] }}</div>
                    @endif
                </div>
                @endforeach
            @else
                <p class="description">Belum ada pengalaman kerja. Klik Edit Profil untuk menambahkan.</p>
            @endif
        </div>

        <div class="card card-content">
            <h2 class="section-title">Pendidikan</h2>
            @if($mahasiswa->pendidikan && count($mahasiswa->pendidikan) > 0)
                @foreach($mahasiswa->pendidikan as $edu)
                <div class="education-item">
                    <div class="item-title">{{ $edu['degree'] ?? '' }}</div>
                    <div class="item-company">{{ $edu['institution'] ?? '' }}</div>
                    <div class="item-date">
                        <i class="far fa-calendar"></i> {{ $edu['years'] ?? '' }}
                    </div>
                    @if(isset($edu['description']))
                    <div class="item-description">{{ $edu['description'] }}</div>
                    @endif
                </div>
                @endforeach
            @else
                <p class="description">Belum ada riwayat pendidikan. Klik Edit Profil untuk menambahkan.</p>
            @endif
        </div>

        <div class="card card-content">
            <h2 class="section-title">Keahlian</h2>
            @if($mahasiswa->skills && count($mahasiswa->skills) > 0)
                <div class="skills-container">
                    @foreach($mahasiswa->skills as $skill)
                        <span class="skill-tag">{{ $skill }}</span>
                    @endforeach
                </div>
            @else
                <p class="description">Belum ada skill. Klik Edit Profil untuk menambahkan.</p>
            @endif
        </div>

        <div class="card card-content">
            <h2 class="section-title">Kemampuan Bahasa</h2>
            @if($mahasiswa->bahasa && count($mahasiswa->bahasa) > 0)
                @foreach($mahasiswa->bahasa as $lang)
                <div class="language-item">
                    <span class="language-name">{{ $lang['nama'] ?? '' }}</span>
                    <span class="language-level">{{ $lang['level'] ?? '' }}</span>
                </div>
                @endforeach
            @else
                <p class="description">Belum ada informasi bahasa. Klik Edit Profil untuk menambahkan.</p>
            @endif
        </div>
    </div>

</body>
</html>
@endsection
