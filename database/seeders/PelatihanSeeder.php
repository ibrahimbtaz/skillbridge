<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\User;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Pelatihan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $user_ids = User::where('role', '2')->pluck('id');
        $mitra_ids = Mitra::whereIn('user_id', $user_ids)->pluck('id');
        $thumbs = collect(File::files(public_path('assets/pelatihan/thumb')))
        ->map(fn($file) => 'assets/pelatihan/thumb/' . $file->getFilename())
        ->shuffle();
        foreach ($mitra_ids as $id) {
            $mitra = Mitra::find($id);
            $thumb = $thumbs->shift();
            for ($i = 0; $i < rand(3, 5); $i++) {
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
                    'mitra_id' => $id,
                ]);
            }
        }
    }
}
