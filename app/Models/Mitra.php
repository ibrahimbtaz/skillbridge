<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Lokers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Mitra extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "mitras";
    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'nama_mitra',
        'deskripsi',
        'industri',
        'email',
        'telepon',
        'website',
        'alamat',
        'provinsi',
        'kota',
        'logo',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function loker()
    {
        return $this->hasMany(Loker::class, 'mitra_id');
    }

    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-company-logo.png');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($mitra) {
            if ($mitra->logo && \Storage::disk('public')->exists($mitra->logo)) {
                \Storage::disk('public')->delete($mitra->logo);
            }
        });
    }

}
