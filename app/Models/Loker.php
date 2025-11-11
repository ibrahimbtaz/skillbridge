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

    protected $casts = [
    'tanggung_jawab' => 'array',
    'kualifikasi' => 'array',
    'benefits' => 'array',
    'deadline' => 'date',
];

    public function mitra() {
        return $this->belongsTo(Mitra::class, 'mitra_id');
    }

}
