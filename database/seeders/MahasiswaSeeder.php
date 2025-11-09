<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        Mahasiswa::truncate();
        $user_ids = User::where('role', '3')->pluck('id');
        foreach ($user_ids as $id) {
            Mahasiswa::create([
                'nim' => date('Y') . fake()->numberBetween(51, 59) . str_pad(fake()->unique()->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
                'nama' => fake()->name(),
                'jurusan' => fake()->randomElement(['Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Teknik Mesin']),
                'semester' => fake()->numberBetween(1, 8),
                'alamat' => fake()->address(),
                'no_telp' => fake()->phoneNumber(),
                'tanggal_lahir' => fake()->date(),
                'user_id' => $id,
            ]);
        }

    }
}
