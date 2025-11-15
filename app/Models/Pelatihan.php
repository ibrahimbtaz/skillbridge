<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihans';

    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'kategori',
        'thumbnail',
        'rating',
        'tags',
        'persyaratan',
        'mitra_id',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }
}
