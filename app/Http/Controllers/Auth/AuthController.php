<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === '1') {
                return redirect('/dashboard')->with('success', 'Berhasil Login');
            }
            return redirect(route('home'))->with('success', 'Berhasil Login');
        }
        return back()->with('error', 'Login gagal');
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


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
