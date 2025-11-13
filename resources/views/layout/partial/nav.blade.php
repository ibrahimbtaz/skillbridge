<style>
    /* Navbar */
    .navbar {
        background-color: darkblue;
        padding: 15px 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-brand {
        color: white;
        font-size: 1.5em;
        font-weight: 700;
        text-decoration: none;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 30px;
    }

    .navbar-menu a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .navbar-menu a:hover {
        color: #87ceeb;
    }

    .user-info {
        color: white;
        font-size: 0.95em;
    }

    .user-info strong {
        color: #87ceeb;
    }

    .logout-button {
        background-color: #ff6b6b;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.95em;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .logout-button:hover {
        background-color: #ee5a52;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: column;
            gap: 15px;
        }

        .navbar-menu {
            flex-direction: column;
            gap: 15px;
        }
    }

    @media (max-width: 480px) {
        .navbar-menu {
            gap: 10px;
        }

        .user-info {
            font-size: 0.8em;
        }

        .logout-button {
            padding: 8px 15px;
            font-size: 0.85em;
        }
    }
</style>

<!-- Navbar -->
<div class="navbar">
    <a href="/home" class="navbar-brand">Skillbridge</a>
    <div class="navbar-menu">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('loker.index') }}">Lowongan Kerja</a>
        <a href="{{ route('pelatihan.index') }}">Pelatihan</a>
        @auth
            <div class="user-info">
                @php $u = Auth::user(); @endphp
                @if ($u->role === '3')
                    Halo, <strong><a href="{{ route('mahasiswa.profile', $u->mahasiswa->id) }}">{{ $u->mahasiswa->nama ?? 'Data mahasiswa tidak ditemukan'  }}</a></strong>
                @endif
                @if ($u->role === '2')
                    Halo, <strong><a href="{{ route('mitra.show', $u->mitra->id) }}">{{ $u->mitra->nama_mitra ?? 'Data mitra tidak ditemukan' }}</a></strong>
                @endif
                @if ($u->role === '1')
                    Halo, <strong>{{ $u->kampus->nama }}</strong>
                @endif
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        @else
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        @endauth
    </div>
</div>
