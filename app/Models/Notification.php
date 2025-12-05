<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'title',
        'message',
        'icon',
        'color',
        'link',
        'data',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk notification yang belum dibaca
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope untuk notification yang sudah dibaca
     */
    public function scopeRead($query)
    {
        return $query->whereNotNull('read_at');
    }

    /**
     * Cek apakah notification sudah dibaca
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * Tandai notification sebagai sudah dibaca
     */
    public function markAsRead(): void
    {
        if (!$this->isRead()) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Tandai notification sebagai belum dibaca
     */
    public function markAsUnread(): void
    {
        $this->update(['read_at' => null]);
    }

    /**
     * Helper untuk mendapatkan icon class
     */
    public function getIconClassAttribute(): string
    {
        $icons = [
            'lamaran_baru' => 'fa-file-alt',
            'status_lamaran' => 'fa-bell',
            'status_accepted' => 'fa-check-circle',
            'status_rejected' => 'fa-times-circle',
            'status_interview' => 'fa-calendar-alt',
            'status_reviewed' => 'fa-eye',
        ];

        return $icons[$this->type] ?? ($this->icon ?? 'fa-bell');
    }

    /**
     * Helper untuk mendapatkan background color class
     */
    public function getColorClassAttribute(): string
    {
        $colors = [
            'blue' => 'bg-blue-100 text-blue-600',
            'green' => 'bg-green-100 text-green-600',
            'red' => 'bg-red-100 text-red-600',
            'yellow' => 'bg-yellow-100 text-yellow-600',
            'purple' => 'bg-purple-100 text-purple-600',
            'orange' => 'bg-orange-100 text-orange-600',
        ];

        return $colors[$this->color] ?? $colors['blue'];
    }

    /**
     * Format waktu relatif
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Static method untuk membuat notification lamaran baru (untuk Mitra)
     */
    public static function createLamaranBaru($mitraUserId, $mahasiswa, $loker): self
    {
        return self::create([
            'user_id' => $mitraUserId,
            'type' => 'lamaran_baru',
            'title' => 'Lamaran Baru',
            'message' => "{$mahasiswa->nama} melamar pada posisi {$loker->title}",
            'icon' => 'fa-file-alt',
            'color' => 'blue',
            'link' => route('mitra.pelamar.detail', $loker->id),
            'data' => [
                'mahasiswa_id' => $mahasiswa->id,
                'mahasiswa_nama' => $mahasiswa->nama,
                'loker_id' => $loker->id,
                'loker_title' => $loker->title,
            ],
        ]);
    }

    /**
     * Static method untuk membuat notification status lamaran (untuk Mahasiswa)
     */
    public static function createStatusLamaran($mahasiswaUserId, $loker, $status, $mitraNama): self
    {
        $statusLabels = [
            'pending' => 'Menunggu',
            'reviewed' => 'Sedang Ditinjau',
            'interview' => 'Undangan Interview',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];

        $statusColors = [
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'interview' => 'purple',
            'accepted' => 'green',
            'rejected' => 'red',
        ];

        $statusIcons = [
            'pending' => 'fa-clock',
            'reviewed' => 'fa-eye',
            'interview' => 'fa-calendar-alt',
            'accepted' => 'fa-check-circle',
            'rejected' => 'fa-times-circle',
        ];

        $label = $statusLabels[$status] ?? $status;
        $color = $statusColors[$status] ?? 'blue';
        $icon = $statusIcons[$status] ?? 'fa-bell';

        $message = match($status) {
            'reviewed' => "Lamaran Anda untuk posisi {$loker->title} di {$mitraNama} sedang ditinjau.",
            'interview' => "Selamat! Anda diundang interview untuk posisi {$loker->title} di {$mitraNama}.",
            'accepted' => "Selamat! Lamaran Anda untuk posisi {$loker->title} di {$mitraNama} diterima!",
            'rejected' => "Maaf, lamaran Anda untuk posisi {$loker->title} di {$mitraNama} tidak dapat dilanjutkan.",
            default => "Status lamaran Anda untuk posisi {$loker->title} diperbarui menjadi {$label}.",
        };

        return self::create([
            'user_id' => $mahasiswaUserId,
            'type' => 'status_' . $status,
            'title' => "Status Lamaran: {$label}",
            'message' => $message,
            'icon' => $icon,
            'color' => $color,
            'link' => route('mahasiswa.status_loker'),
            'data' => [
                'loker_id' => $loker->id,
                'loker_title' => $loker->title,
                'mitra_nama' => $mitraNama,
                'status' => $status,
            ],
        ]);
    }
}
