<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pelatihan;
use App\Models\Loker;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Mitra;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function kelola_user(Request $request)
    {
        $query = User::with(['mahasiswa', 'mitra']);

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhereHas('mahasiswa', function($subQuery) use ($search) {
                        $subQuery->where('nama', 'like', '%' . $search . '%');
                    })
                  ->orWhereHas('mitra', function($subQuery) use ($search) {
                        $subQuery->where('nama_mitra', 'like', '%' . $search . '%');
                    });
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $users = $query->orderBy('id', 'asc')->get();

        // Statistics
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', '3')->count();
        $totalMitra = User::where('role', '2')->count();
        $totalAdmin = User::where('role', '1')->count();

        return view('page.admin.user.kelola', compact(
            'users',
            'totalUsers',
            'totalMahasiswa',
            'totalMitra',
            'totalAdmin'
        ));
    }

    public function edit_user($id)
    {
        $user = User::with(['mahasiswa', 'mitra'])->findOrFail($id);
        return view('page.admin.user.edit', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:1,2,3',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.kelola.user')
            ->with('success', 'User berhasil diperbarui!');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.kelola.user')
                ->with('error', 'Tidak dapat menghapus akun sendiri!');
        }

        // Delete related data
        if ($user->mahasiswa) {
            $user->mahasiswa->delete();
        }
        if ($user->mitra) {
            $user->mitra->delete();
        }

        $user->delete();

        return redirect()->route('admin.kelola.user')
            ->with('success', 'User berhasil dihapus!');
    }

    public function audit_loker(Request $request)
    {
        $query = Loker::with('mitra');

        // Filter by search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereHas('mitra', function($q2) use ($search) {
                      $q2->where('nama_mitra', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis kerja
        if ($request->filled('jenis_kerja')) {
            $query->where('jenis_kerja', $request->jenis_kerja);
        }

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $lokers = $query->orderBy('id', 'asc')->get();

        // Statistics
        $totalLoker = Loker::count();
        $pendingCount = Loker::pending()->count();
        $approvedCount = Loker::approved()->count();
        $rejectedCount = Loker::rejected()->count();

        return view('page.admin.loker.audit', compact(
            'lokers',
            'totalLoker',
            'pendingCount',
            'approvedCount',
            'rejectedCount'
        ));
    }

    public function approve_loker($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Loker berhasil diapprove!');
    }

    public function reject_loker($id)
    {
        $loker = Loker::findOrFail($id);
        $loker->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Loker berhasil direject!');
    }

        public function audit_pelatihan(Request $request)
    {
        $query = Pelatihan::query();

        // Filter by search
        if ($request->filled('search')) {
            $query->where('nama_pelatihan', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by date range
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $pelatihans = $query->orderBy('id', 'asc')->get();

        // Statistics
        $totalPelatihan = Pelatihan::count();
        $pendingCount = Pelatihan::pending()->count();
        $approvedCount = Pelatihan::approved()->count();
        $rejectedCount = Pelatihan::rejected()->count();
        $kategoris = Pelatihan::distinct()->pluck('kategori')->filter();

        return view('page.admin.pelatihan.audit', compact(
            'pelatihans',
            'totalPelatihan',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'kategoris'
        ));
    }

    public function approve_pelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Pelatihan berhasil diapprove!');
    }

    public function reject_pelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);
        $pelatihan->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Pelatihan berhasil direject!');
    }

    public function kelola_pelatihan(Request $request)
    {
        $query = Pelatihan::query();

        // Filter by search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pelatihan', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by rating range
        if ($request->filled('rating')) {
            switch ($request->rating) {
                case '4+':
                    $query->where('rating', '>=', 4);
                    break;
                case '3+':
                    $query->where('rating', '>=', 3);
                    break;
                case '2+':
                    $query->where('rating', '>=', 2);
                    break;
                case '1+':
                    $query->where('rating', '>=', 1);
                    break;
            }
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'nama_asc':
                    $query->orderBy('nama_pelatihan', 'asc');
                    break;
                case 'nama_desc':
                    $query->orderBy('nama_pelatihan', 'desc');
                    break;
                case 'rating_desc':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'rating_asc':
                    $query->orderBy('rating', 'asc');
                    break;
                case 'terbaru':
                    $query->latest();
                    break;
                case 'terlama':
                    $query->oldest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->orderBy('id', 'asc')->get();
        }

        $pelatihans = $query->orderBy('id', 'asc')->get();
        $totalPelatihan = Pelatihan::count();
        $approvedCount = Pelatihan::where('status', 'approved')->count();
        $pendingCount = Pelatihan::where('status', 'pending')->count();
        $rejectedCount = Pelatihan::where('status', 'rejected')->count();
        $kategoris = Pelatihan::distinct()->pluck('kategori')->filter();

        return view('page.admin.pelatihan.kelola', compact('pelatihans', 'totalPelatihan', 'approvedCount', 'pendingCount', 'rejectedCount', 'kategoris'));
    }

    public function detail_pelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        return view('page.admin.pelatihan.detail', compact('pelatihan'));
    }

    public function edit_pelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        return view('page.admin.pelatihan.edit', compact('pelatihan'));
    }

    public function update_pelatihan(Request $request, $id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'tags' => 'nullable|string',
            'persyaratan' => 'nullable|string',
        ]);

        $data = [
            'nama_pelatihan' => $request->nama_pelatihan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'rating' => $request->rating ?? $pelatihan->rating,
        ];

        // Handle tags - convert comma separated to JSON array
        if ($request->tags) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
            $data['tags'] = json_encode($tagsArray);
        }

        // Handle persyaratan - convert newline separated to JSON array
        if ($request->persyaratan) {
            $persyaratanArray = array_filter(array_map('trim', explode("\n", $request->persyaratan)));
            $data['persyaratan'] = json_encode(array_values($persyaratanArray));
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($pelatihan->thumbnail && file_exists(public_path($pelatihan->thumbnail))) {
                unlink(public_path($pelatihan->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/pelatihan/thumb'), $filename);
            $data['thumbnail'] = 'assets/pelatihan/thumb/' . $filename;
        }

        $pelatihan->update($data);

        return redirect()->route('admin.kelola.pelatihan.detail', $pelatihan->id)
            ->with('success', 'Pelatihan berhasil diperbarui!');
    }

    public function create_pelatihan()
    {
        return view('page.admin.pelatihan.create');
    }

    public function store_pelatihan(Request $request)
    {
        $request->validate([
            'nama_pelatihan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'tags' => 'nullable|string',
            'persyaratan' => 'nullable|string',
        ]);

        $data = [
            'nama_pelatihan' => $request->nama_pelatihan,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'rating' => $request->rating ?? 0,
            'status' => 'pending', // Status pending untuk menunggu approval
        ];

        // Handle tags - convert comma separated to JSON array
        if ($request->tags) {
            $tagsArray = array_map('trim', explode(',', $request->tags));
            $data['tags'] = json_encode($tagsArray);
        }

        // Handle persyaratan - convert newline separated to JSON array
        if ($request->persyaratan) {
            $persyaratanArray = array_filter(array_map('trim', explode("\n", $request->persyaratan)));
            $data['persyaratan'] = json_encode(array_values($persyaratanArray));
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/pelatihan/thumb'), $filename);
            $data['thumbnail'] = 'assets/pelatihan/thumb/' . $filename;
        }

        $pelatihan = Pelatihan::create($data);

        return redirect()->route('admin.kelola.pelatihan.detail', $pelatihan->id)
            ->with('success', 'Pelatihan berhasil ditambahkan!');
    }

    public function delete_pelatihan($id)
    {
        $pelatihan = Pelatihan::findOrFail($id);

        // Delete thumbnail if exists
        if ($pelatihan->thumbnail && file_exists(public_path($pelatihan->thumbnail))) {
            unlink(public_path($pelatihan->thumbnail));
        }

        $pelatihan->delete();

        return redirect()->route('admin.kelola.pelatihan')
            ->with('success', 'Pelatihan berhasil dihapus!');
    }
}
