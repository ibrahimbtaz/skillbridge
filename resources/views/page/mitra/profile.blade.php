@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mitra - PT. Solusi Digital</title>
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
        .company-logo {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            border: 1px solid #eee;
            flex-shrink: 0;
        }
        .company-title h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 4px;
        }
        .company-title p {
            font-size: 16px;
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
        }
        .btn-primary { background: #2563eb; color: white; }
        .btn-primary:hover { background: #1d4ed8; }

        /* Detail Kontak & Info */
        .company-details {
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


        /* Deskripsi & Lowongan */
        .card-content {
            padding: 24px;
        }
        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }
        .description {
            color: #4b5563;
            line-height: 1.8;
        }

    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
        <a href="{{ auth()->user()->id === $mitra->user_id ? route('home') : ( isset($loker) ? route('loker.show', $loker) : route('home') ) }}" class="back-btn"> <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
            Kembali
        </a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="profile-header">
                <img src="{{asset($mitra->logo)}}" alt="Logo Perusahaan" class="company-logo">
                <div class="company-title">
                    <h1>{{ $mitra->nama_mitra }}</h1>
                    <p>{{ $mitra->kota }}, {{ $mitra->provinsi }}</p>
                </div>

                @if (auth()->check() && auth()->user()->role == 2)
                    <div class="profile-actions">
                        <a href="{{ route('dashboard', $mitra->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Dashboard Mitra
                        </a>
                    </div>
                @endif
            </div>

            <div class="company-details">
                <div class="detail-item">
                    <i class="fas fa-building"></i>
                    <div>
                        <div class="label">Industri</div>
                        <div class="value">{{ $mitra->industri }}</div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <div class="label">Email</div>
                        <div class="value"><a href="mailto:{{ $mitra->email }}">{{ $mitra->email }}</a></div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <div class="label">No. Telepon</div>
                        <div class="value">{{ $mitra->telepon }}</div>
                    </div>
                </div>
                <div class="detail-item">
                    <i class="fas fa-globe"></i>
                    <div>
                        <div class="label">Website</div>
                        <div class="value"><a href="{{ $mitra->website }}" target="_blank">{{ substr($mitra->website, 0, 30) }}{{ strlen($mitra->website) > 30 ? '...' : '' }}</a></div>
                    </div>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <div class="label">Alamat Perusahaan</div>
                        <div class="value">{{ $mitra->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-content">
            <h2 class="section-title">Deskripsi Perusahaan</h2>
            <p class="description">
                {{ $mitra->deskripsi }}
            </p>
        </div>

         </div>
</body>
</html>
@endsection
