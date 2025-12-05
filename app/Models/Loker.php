<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mitra;
use App\Models\Mahasiswa;


class Loker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "lokers";
    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'deskripsi',
        'lokasi',
        'jenis_kerja',
        'tipe_kerja',
        'gaji_min',
        'gaji_max',
        'tanggung_jawab',
        'kualifikasi',
        'benefits',
        'deadline',
        'mitra_id',
        'status'
    ];

    protected $casts = [
        'tanggung_jawab' => 'array',  // ✅ Cast ke array
        'kualifikasi' => 'array',
        'benefits' => 'array',
        'deadline' => 'date',
        'gaji_min' => 'integer',
        'gaji_max' => 'integer',
    ];

    // Scope untuk loker yang approved
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope untuk loker yang pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope untuk loker yang rejected
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }


    public function mitra() {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

    // Relasi ke mahasiswa yang melamar
    public function pelamar() {
        return $this->belongsToMany(Mahasiswa::class, 'loker_mahasiswa')
                    ->withPivot('status', 'catatan', 'catatan_mitra')
                    ->withTimestamps();
    }

    // Cek apakah mahasiswa sudah melamar
    public function hasApplied($mahasiswaId) {
        return $this->pelamar()->where('mahasiswa_id', $mahasiswaId)->exists();
    }

}
