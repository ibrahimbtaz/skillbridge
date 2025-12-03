<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use App\Models\Mitra; // Dihapus karena tidak lagi dipakai
// use App\Models\User;  // Dihapus karena tidak lagi dipakai
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Pelatihan;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset Database
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Pelatihan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Ambil file thumbnail
        $thumbs = collect(File::files(public_path('assets/pelatihan/thumb')))
            ->map(fn($file) => 'assets/pelatihan/thumb/' . $file->getFilename())
            ->shuffle();

        // Loop sederhana untuk membuat data dummy (misal: 10 pelatihan)
        // Anda bisa mengubah angka 10 sesuai kebutuhan
        for ($i = 0; $i < 10; $i++) {

            // Ambil thumbnail (jika ada sisa, ambil satu, jika habis pakai null atau string default)
            $thumb = $thumbs->isNotEmpty() ? $thumbs->shift() : null;

            Pelatihan::create([
                'nama_pelatihan' => fake()->sentence(3),
                'deskripsi' => fake()->paragraph(),
                'kategori' => fake()->randomElement(['Programming', 'Design', 'Business', 'Marketing', 'Data Science']),
                'thumbnail' => $thumb,
                'rating' => fake()->randomFloat(2, 0, 5),
                'tags' => json_encode([fake()->word(), fake()->word(), fake()->word()]),
                'persyaratan' => json_encode([
                    fake()->sentence(),
                    fake()->sentence()
                ]),
                // 'mitra_id' => $id, // BAGIAN INI SUDAH DIHAPUS
            ]);
        }
    }
}
