<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>CV - {{ $mahasiswa->nama }}</title>
    <style>
        /* ATS-Friendly CV Style */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000000;
            background: #ffffff;
            padding: 40px;
        }

        /* Header - Name and Contact */
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000000;
            padding-bottom: 15px;
        }

        .name {
            font-size: 24pt;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }

        .contact-info {
            font-size: 10pt;
            color: #333333;
        }

        .contact-info span {
            margin: 0 8px;
        }

        .contact-info span:not(:last-child)::after {
            content: " | ";
            margin-left: 8px;
        }

        /* Section Styles */
        .section {
            margin-bottom: 18px;
        }

        .section-title {
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1px solid #000000;
            padding-bottom: 4px;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        /* Summary/Bio */
        .summary {
            text-align: justify;
            font-size: 10pt;
        }

        /* Experience & Education Items */
        .item {
            margin-bottom: 12px;
        }

        .item-header {
            display: table;
            width: 100%;
            margin-bottom: 2px;
        }

        .item-title {
            font-weight: bold;
            font-size: 11pt;
        }

        .item-date {
            float: right;
            font-size: 10pt;
            font-style: italic;
        }

        .item-subtitle {
            font-size: 10pt;
            color: #333333;
            font-style: italic;
        }

        .item-description {
            font-size: 10pt;
            margin-top: 4px;
        }

        /* Skills */
        .skills-list {
            font-size: 10pt;
        }

        .skill-category {
            margin-bottom: 4px;
        }

        .skill-label {
            font-weight: bold;
        }

        /* Languages */
        .language-item {
            display: inline-block;
            margin-right: 20px;
            font-size: 10pt;
        }

        /* Contact Links */
        .links {
            font-size: 10pt;
        }

        .link-item {
            margin-bottom: 2px;
        }

        /* Utility */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    {{-- Header: Name and Contact --}}
    <div class="header">
        <h1 class="name">{{ $mahasiswa->nama }}</h1>
        <div class="contact-info">
            @if($mahasiswa->alamat)
                <span>{{ $mahasiswa->alamat }}</span>
            @endif
            @if($mahasiswa->no_telp)
                <span>{{ $mahasiswa->no_telp }}</span>
            @endif
            @if($mahasiswa->user && $mahasiswa->user->email)
                <span>{{ $mahasiswa->user->email }}</span>
            @endif
        </div>
        @if($mahasiswa->kontak_tambahan)
            <div class="contact-info" style="margin-top: 5px;">
                @if(isset($mahasiswa->kontak_tambahan['linkedin']))
                    <span>LinkedIn: {{ $mahasiswa->kontak_tambahan['linkedin'] }}</span>
                @endif
                @if(isset($mahasiswa->kontak_tambahan['github']))
                    <span>GitHub: {{ $mahasiswa->kontak_tambahan['github'] }}</span>
                @endif
                @if(isset($mahasiswa->kontak_tambahan['portfolio']))
                    <span>Portfolio: {{ $mahasiswa->kontak_tambahan['portfolio'] }}</span>
                @endif
            </div>
        @endif
    </div>

    {{-- Professional Summary / Bio --}}
    @if($mahasiswa->bio)
        <div class="section">
            <h2 class="section-title">Ringkasan Profil</h2>
            <p class="summary">{{ $mahasiswa->bio }}</p>
        </div>
    @endif

    {{-- Education --}}
    @if($mahasiswa->pendidikan && count($mahasiswa->pendidikan) > 0)
        <div class="section">
            <h2 class="section-title">Pendidikan</h2>
            @foreach($mahasiswa->pendidikan as $edu)
                <div class="item clearfix">
                    <div class="item-header">
                        <span class="item-title">{{ $edu['degree'] ?? '-' }}</span>
                        <span class="item-date">{{ $edu['years'] ?? '' }}</span>
                    </div>
                    <div class="item-subtitle">{{ $edu['institution'] ?? '-' }}</div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Fallback jika tidak ada data pendidikan terstruktur --}}
        <div class="section">
            <h2 class="section-title">Pendidikan</h2>
            <div class="item">
                <div class="item-title">{{ $mahasiswa->jurusan ?? 'Jurusan tidak disebutkan' }}</div>
                <div class="item-subtitle">Semester {{ $mahasiswa->semester ?? '-' }}</div>
            </div>
        </div>
    @endif

    {{-- Work Experience --}}
    @if($mahasiswa->pengalaman && count($mahasiswa->pengalaman) > 0)
        <div class="section">
            <h2 class="section-title">Pengalaman</h2>
            @foreach($mahasiswa->pengalaman as $exp)
                <div class="item clearfix">
                    <div class="item-header">
                        <span class="item-title">{{ $exp['title'] ?? '-' }}</span>
                        <span class="item-date">{{ $exp['dates'] ?? '' }}</span>
                    </div>
                    <div class="item-subtitle">{{ $exp['company'] ?? '-' }}</div>
                    @if(isset($exp['description']))
                        <div class="item-description">{{ $exp['description'] }}</div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    {{-- Skills --}}
    @if($mahasiswa->skills && count($mahasiswa->skills) > 0)
        <div class="section">
            <h2 class="section-title">Keahlian</h2>
            <div class="skills-list">
                <p>{{ implode(' • ', $mahasiswa->skills) }}</p>
            </div>
        </div>
    @endif

    {{-- Languages --}}
    @if($mahasiswa->bahasa && count($mahasiswa->bahasa) > 0)
        <div class="section">
            <h2 class="section-title">Bahasa</h2>
            <div>
                @foreach($mahasiswa->bahasa as $lang)
                    <span class="language-item">
                        <strong>{{ $lang['nama'] ?? '-' }}</strong>
                        @if(isset($lang['level']))
                            ({{ $lang['level'] }})
                        @endif
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Additional Information --}}
    <div class="section">
        <h2 class="section-title">Informasi Tambahan</h2>
        <div class="skills-list">
            <p><span class="skill-label">NIM:</span> {{ $mahasiswa->nim }}</p>
            @if($mahasiswa->tanggal_lahir)
                <p><span class="skill-label">Tanggal Lahir:</span> {{ $mahasiswa->tanggal_lahir }}</p>
            @endif
        </div>
    </div>

</body>
</html>
