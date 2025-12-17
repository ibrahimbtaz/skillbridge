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
        @if(session('success'))
            <div class="alert" style="background: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; border: 1px solid #10b981;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert" style="background: #fee2e2; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 16px; border: 1px solid #ef4444;">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h1>Status Lamaran Saya</h1>
            </div>
            <div class="card-body">
                @forelse($lamaran as $loker)
                    @php
                        $statusLabels = [
                            'pending' => 'Terkirim',
                            'reviewed' => 'Ditinjau',
                            'interview' => 'Interview',
                            'accepted' => 'Diterima',
                            'rejected' => 'Ditolak',
                        ];
                        $statusClass = [
                            'pending' => 'status-Terkirim',
                            'reviewed' => 'status-Ditinjau',
                            'interview' => 'status-Interview',
                            'accepted' => 'status-Diterima',
                            'rejected' => 'status-Ditolak',
                        ];
                    @endphp
                    <div class="lamaran-item">
                        <div>
                            <a href="{{ route('loker.show', $loker->id) }}" style="text-decoration: none;">
                                <div class="job-title">{{ $loker->title }}</div>
                            </a>
                            <div class="company-name">{{ $loker->mitra->nama_mitra }}</div>
                            <div class="apply-date">Dilamar pada: {{ $loker->pivot->created_at->format('d M Y') }}</div>
                            @if($loker->pivot->catatan)  
                                <div style="font-size: 0.85em; color: #666; margin-top: 4px;">
                                    <i>Catatan: "{{ Str::limit($loker->pivot->catatan, 50) }}"</i>
                                </div>
                            @endif
                            @if($loker->pivot->catatan_mitra)
                                <div style="font-size: 0.85em; color: #4338ca; margin-top: 4px;">
                                    <strong>Feedback:</strong> {{ $loker->pivot->catatan_mitra }}
                                </div>
                            @endif
                        </div>
                        <div style="display: flex; align-items: center;">
                            <span class="status {{ $statusClass[$loker->pivot->status] ?? 'status-Terkirim' }}">
                                {{ $statusLabels[$loker->pivot->status] ?? 'Terkirim' }}
                            </span>

                            @if($loker->pivot->status === 'pending')
                                <form action="{{ route('loker.cancel', $loker->id) }}" method="POST" style="margin-left: 10px;"
                                      onsubmit="return confirm('Apakah Anda yakin ingin membatalkan lamaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-batal">
                                        Batalkan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="no-data">
                        <i class="fas fa-inbox" style="font-size: 48px; color: #ccc; margin-bottom: 16px; display: block;"></i>
                        <p>Anda belum melamar pekerjaan apapun.</p>
                        <a href="{{ route('loker.index') }}" style="color: #4338ca; text-decoration: underline;">Cari Lowongan</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
@endsection
