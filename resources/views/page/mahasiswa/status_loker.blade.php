@extendS('layout.main')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Lamaran Saya</title>
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; }
        .container { max-width: 900px; margin: 20px auto; }
        .card { background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-header { padding: 20px; border-bottom: 1px solid #eee; }
        .card-header h1 { margin: 0; }
        .card-body { padding: 20px; }
        
        .lamaran-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .lamaran-item:last-child { border-bottom: none; }
        .job-title { font-weight: bold; font-size: 1.1em; color: #333; }
        .company-name { color: #555; font-size: 0.9em; }
        .apply-date { color: #888; font-size: 0.8em; margin-top: 4px; }
        
        .status {
            font-weight: bold;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9em;
            text-align: center;
        }
        /* Pewarnaan Status */
        .status-Terkirim { background: #e0e7ff; color: #4338ca; }
        .status-Ditinjau { background: #fef3c7; color: #b45309; }
        .status-Interview { background: #d1fae5; color: #065f46; }
        .status-Ditolak { background: #fee2e2; color: #b91c1c; }
        .status-Diterima { background: #cceeff; color: #0056b3; } /* Contoh tambahan */

        .btn-batal {
            background: #fee2e2;
            color: #b91c1c;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 0.9em;
            margin-left: 10px;
            cursor: pointer; /* Menambahkan cursor pointer */
        }
        
        /* Untuk kasus jika tidak ada lamaran */
        .no-data {
            text-align: center;
            color: #777;
            padding: 30px 0;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Status Lamaran Saya</h1>
            </div>
            <div class="card-body">

                <div class="lamaran-item">
                    <div>
                        <div class="job-title">Senior Backend Developer</div>
                        <div class="company-name">PT Teknologi Maju</div>
                        <div class="apply-date">Dilamar pada: 07 Nov 2025</div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="status status-Terkirim">
                            Terkirim
                        </span>
                        
                        <a href="#" class="btn-batal">
                           Batalkan
                        </a>
                    </div>
                </div>

                <div class="lamaran-item">
                    <div>
                        <div class="job-title">Full Stack Developer</div>
                        <div class="company-name">CV Digital Solutions</div>
                        <div class="apply-date">Dilamar pada: 05 Nov 2025</div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="status status-Ditinjau">
                            Ditinjau
                        </span>
                    </div>
                </div>
                
                <div class="lamaran-item">
                    <div>
                        <div class="job-title">UI/UX Designer</div>
                        <div class="company-name">Start-up Inovasi</div>
                        <div class="apply-date">Dilamar pada: 01 Nov 2025</div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="status status-Interview">
                            Interview
                        </span>
                    </div>
                </div>
                
                <div class="lamaran-item">
                    <div>
                        <div class="job-title">Data Analyst</div>
                        <div class="company-name">Perusahaan Analitika Data</div>
                        <div class="apply-date">Dilamar pada: 28 Okt 2025</div>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span class="status status-Ditolak">
                            Ditolak
                        </span>
                    </div>
                </div>
                
                </div>
        </div>
    </div>
</body>
</html>
@endsection