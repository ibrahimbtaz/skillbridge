<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelatihan extends Model
{
    use SoftDeletes;

    protected $table = 'pelatihans';

    protected $fillable = [
        'nama_pelatihan',
        'deskripsi',
        'kategori',
        'thumbnail',
        'rating',
        'tags',
        'persyaratan',
        'status',
    ];

    // Scope untuk pelatihan yang approved
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    // Scope untuk pelatihan yang pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope untuk pelatihan yang rejected
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
