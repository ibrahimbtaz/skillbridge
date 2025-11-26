<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|max:255'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 255 karakter',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === '1') {
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, ' . $user->name);
            }
            return redirect()->intended(route('home'))->with('success', 'Selamat datang, ' . $user->name);
        }
        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->with('error', 'Login gagal! Silakan coba lagi.');
    }

    public function register($type = null)
    {
        if ($type === null) {
            return view('auth.register');
        }
        if ($type === 'mhs') {
            return view('auth.mahasiswa.register');
        }

        if ($type === 'mtr') {
            return view('auth.mitra.register');
        }

    }

    // Proses Register
    public function register_mahasiswa(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nim'           => 'required|unique:mahasiswas,nim',
            'nama'          => 'required|string',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6|confirmed', // butuh field password_confirmation di form
            'jurusan'       => 'required',
            'semester'      => 'required|integer',
            'alamat'        => 'nullable|string',
            'no_telp'       => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        // 2. Gunakan Transaction untuk simpan ke 2 tabel
        DB::transaction(function () use ($request) {

            // A. Buat Akun User (untuk Login)
            $user = User::create([
                'name'      => $request->nama,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            // B. Buat Data Mahasiswa (Link ke User ID tadi)
            Mahasiswa::create([
                'user_id'       => $user->id, // Ambil ID dari user yang baru dibuat
                'nim'           => $request->nim,
                'nama'          => $request->nama,
                'jurusan'       => $request->jurusan,
                'semester'      => $request->semester,
                'alamat'        => $request->alamat,
                'no_telp'       => $request->no_telp,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);

            // C. Otomatis Login setelah register (Opsional)
            Auth::login($user);
        });

        // 3. Redirect jika sukses
        return redirect()->route('home')->with('success', 'Registrasi Berhasil!');
    }

    public function register_mitra(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'nama_mitra'    => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'industri'      => 'required|string',
            'email'         => 'required|email|unique:mitras,email|unique:users,email',
            'password'      => 'required|min:6|confirmed',
            'telepon'       => 'nullable|string|max:20',
            'website'       => 'nullable|url|max:255',
            'alamat'        => 'nullable|string',
            'provinsi'      => 'nullable|string',
            'kota'          => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ], [
            'nama_mitra.required'   => 'Nama perusahaan wajib diisi.',
            'industri.required'     => 'Bidang industri wajib dipilih.',
            'email.required'        => 'Email perusahaan wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            'logo.image'            => 'File harus berupa gambar.',
            'logo.mimes'            => 'Format logo harus JPG, PNG.',
            'logo.max'              => 'Ukuran logo maksimal 2MB.',
            'website.url'           => 'Format website tidak valid.',
        ]);

        // 2. Handle Upload Logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos/mitra', 'public');
        }

        // 3. Gunakan Transaction untuk simpan ke 2 tabel
        DB::transaction(function () use ($request, $logoPath) {

            // A. Buat Akun User (untuk Login)
            $user = User::create([
                'name'      => $request->nama_mitra,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role'      => '2', // Tambahkan role mitra
            ]);

            // B. Buat Data Mitra (Link ke User ID)
            Mitra::create([
                'user_id'       => $user->id,
                'nama_mitra'    => $request->nama_mitra,
                'deskripsi'     => $request->deskripsi,
                'industri'      => $request->industri,
                'email'         => $request->email,
                'telepon'       => $request->telepon,
                'website'       => $request->website,
                'alamat'        => $request->alamat,
                'provinsi'      => $request->provinsi,
                'kota'          => $request->kota,
                'logo'          => $logoPath,
            ]);

            // C. Opsional: Otomatis Login setelah register
            Auth::login($user);
        });

        // 4. Redirect dengan pesan sukses
        return redirect()->route('home')->with('success', 'Registrasi mitra berhasil! Tim kami akan melakukan verifikasi dalam 1-2 hari kerja.');
    }

    public function change_password_form()
    {
        return view('auth.change_password');
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
