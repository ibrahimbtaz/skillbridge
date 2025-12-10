@extends('layout.dashboard.main')
@section('content')
<div class="content-wrapper">
    <!-- Page Title -->
    <h1 class="page-title">
        <i class="fas fa-user-edit"></i> Edit User
    </h1>

    <!-- Back Button -->
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.kelola.user') }}" style="color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 500;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar User
        </a>
    </div>

    @if($errors->any())
    <div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Terjadi kesalahan:</strong>
        </div>
        <ul style="margin: 0; padding-left: 25px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- User Info Card -->
    <div class="content-card" style="margin-bottom: 20px;">
        <div style="display: flex; align-items: center; gap: 20px;">
            @php
                $initials = strtoupper(substr($user->name ?? 'U', 0, 2));
                $roleColors = [
                    '1' => ['bg' => '#ede9fe', 'text' => '#8b5cf6'],
                    '2' => ['bg' => '#fef3c7', 'text' => '#92400e'],
                    '3' => ['bg' => '#dbeafe', 'text' => '#2563eb'],
                ];
                $color = $roleColors[$user->role] ?? ['bg' => '#f3f4f6', 'text' => '#374151'];
            @endphp
            <div style="width: 70px; height: 70px; background: {{ $color['bg'] }}; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; color: {{ $color['text'] }}; font-size: 24px;">
                {{ $initials }}
            </div>
            <div>
                <h2 style="margin: 0 0 5px 0; font-size: 22px;">{{ $user->name }}</h2>
                <p style="margin: 0; color: var(--text-light);">{{ $user->email }}</p>
                <div style="margin-top: 8px;">
                    @php
                        $roleLabels = [
                            '1' => ['icon' => 'fa-user-shield', 'label' => 'Admin', 'bg' => '#ede9fe', 'text' => '#8b5cf6'],
                            '2' => ['icon' => 'fa-building', 'label' => 'Mitra', 'bg' => '#fef3c7', 'text' => '#92400e'],
                            '3' => ['icon' => 'fa-user-graduate', 'label' => 'Mahasiswa', 'bg' => '#dbeafe', 'text' => '#2563eb'],
                        ];
                        $role = $roleLabels[$user->role] ?? ['icon' => 'fa-user', 'label' => 'User', 'bg' => '#f3f4f6', 'text' => '#374151'];
                    @endphp
                    <span style="background: {{ $role['bg'] }}; color: {{ $role['text'] }}; padding: 4px 12px; border-radius: 4px; font-size: 12px; display: inline-flex; align-items: center; gap: 5px;">
                        <i class="fas {{ $role['icon'] }}"></i> {{ $role['label'] }}
                    </span>
                    <span style="color: var(--text-light); font-size: 13px; margin-left: 10px;">
                        <i class="far fa-calendar"></i> Bergabung {{ $user->created_at?->format('d M Y') ?? '' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="content-card">
        <h3 class="card-title" style="margin-bottom: 25px;">
            <i class="fas fa-edit"></i> Edit Informasi User
        </h3>

        <form action="{{ route('admin.kelola.user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                <!-- Nama -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark);">
                        Nama Lengkap <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        placeholder="Masukkan nama lengkap"
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                </div>

                <!-- Email -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark);">
                        Email <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        placeholder="contoh@email.com"
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                </div>

                <!-- Role -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark);">
                        Role <span style="color: #dc2626;">*</span>
                    </label>
                    <select name="role" required
                        style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                        onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'"
                        {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                        <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ old('role', $user->role) == '2' ? 'selected' : '' }}>Mitra</option>
                        <option value="3" {{ old('role', $user->role) == '3' ? 'selected' : '' }}>Mahasiswa</option>
                    </select>
                    @if($user->id === auth()->id())
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        <p style="margin: 5px 0 0 0; font-size: 12px; color: var(--text-light);">
                            <i class="fas fa-info-circle"></i> Tidak dapat mengubah role akun sendiri
                        </p>
                    @endif
                </div>

                <!-- Spacer for grid alignment -->
                <div></div>
            </div>

            <!-- Password Section -->
            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border);">
                <h4 style="margin: 0 0 20px 0; font-size: 16px; color: var(--text-dark);">
                    <i class="fas fa-lock"></i> Ubah Password
                    <span style="font-weight: normal; color: var(--text-light); font-size: 13px;">(Kosongkan jika tidak ingin mengubah)</span>
                </h4>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <!-- New Password -->
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark);">
                            Password Baru
                        </label>
                        <input type="password" name="password"
                            placeholder="Minimal 6 karakter"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-dark);">
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" name="password_confirmation"
                            placeholder="Ulangi password baru"
                            style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 14px; transition: border-color 0.2s;"
                            onfocus="this.style.borderColor='var(--primary)'" onblur="this.style.borderColor='var(--border)'">
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="margin-top: 30px; display: flex; gap: 15px; justify-content: flex-end; padding-top: 20px; border-top: 1px solid var(--border);">
                <a href="{{ route('admin.kelola.user') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @if($user->id !== auth()->id())
    <!-- Danger Zone -->
    <div class="content-card" style="margin-top: 20px; border: 1px solid #fecaca;">
        <h3 class="card-title" style="margin-bottom: 15px; color: #dc2626;">
            <i class="fas fa-exclamation-triangle"></i> Zona Berbahaya
        </h3>
        <p style="color: var(--text-light); margin-bottom: 15px;">
            Menghapus user akan menghapus semua data terkait secara permanen. Tindakan ini tidak dapat dibatalkan.
        </p>
        <form action="{{ route('admin.kelola.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini? Semua data terkait akan hilang secara permanen.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" style="background: #dc2626; color: white; border: none;">
                <i class="fas fa-trash"></i> Hapus User
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
