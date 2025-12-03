<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Loker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "mahasiswas";
    protected $guarded = ['id'];

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'semester',
        'alamat',
        'no_telp',
        'tanggal_lahir',
        'user_id', // Penting agar bisa disambungkan
        // Profile fields
        'foto_profil',
        'bio',
        'pendidikan',
        'pengalaman',
        'skills',
        'kontak_tambahan',
        'bahasa',
    ];

    protected $casts = [
        'pendidikan' => 'array',
        'pengalaman' => 'array',
        'skills' => 'array',
        'kontak_tambahan' => 'array',
        'bahasa' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke loker yang dilamar
    public function lamaran() {
        return $this->belongsToMany(Loker::class, 'loker_mahasiswa')
                    ->withPivot('status', 'catatan', 'catatan_mitra')
                    ->withTimestamps();
    }

    // Cek apakah sudah melamar loker tertentu
    public function hasApplied($lokerId) {
        return $this->lamaran()->where('loker_id', $lokerId)->exists();
    }
}
