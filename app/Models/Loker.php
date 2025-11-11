<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Mitra;


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


    public function mitra() {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

}
