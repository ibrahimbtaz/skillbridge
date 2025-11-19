<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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
}
