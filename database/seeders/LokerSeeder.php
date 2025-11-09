<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Loker;
use App\Models\User;
use App\Models\Mitra;
use Illuminate\Support\Facades\DB;
class LokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Loker::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $user_ids = User::where('role', '2')->pluck('id');
        $mitra_ids = Mitra::whereIn('user_id', $user_ids)->pluck('id');
        foreach ($mitra_ids as $id) {
            // Ambil data lokasi dari mitra yang sedang diproses
            $mitra = Mitra::find($id);
            $lokasi = $mitra->kota . ', ' . $mitra->provinsi; // Format: "Bandung, Jawa Barat"
            for ($i = 0; $i < rand(3, 5); $i++) {
                $gaji_min = fake()->numberBetween(3000000, 7000000);
                $gaji_max = fake()->numberBetween($gaji_min + 1000000, 15000000);
                Loker::create([
                    'title' => fake()->jobTitle(),
                    'deskripsi' => fake()->paragraph(),
                    'lokasi' => $lokasi,
                    'jenis_kerja' => fake()->randomElement(['fulltime', 'parttime', 'freelance', 'contract']),
                    'tipe_kerja' => fake()->randomElement(['onsite', 'remote', 'hybrid']),
                    'gaji_min' => $gaji_min,
                    'gaji_max' => $gaji_max,
                    'tanggung_jawab' => fake()->paragraph(),
                    'kualifikasi' => fake()->paragraph(),
                    'benefits' => fake()->paragraph(),
                    'status' => fake()->randomElement(['draft', 'published', 'closed', 'filled']),
                    'deadline' => fake()->dateTimeBetween('now', '+3 months'),
                    'mitra_id' => $id,
                ]);
            }
        }
    }
}
