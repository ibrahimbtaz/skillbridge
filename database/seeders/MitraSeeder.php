<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;



class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Mitra::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $userIds = User::where('role', '2')->pluck('id');
        $lokasi = [
            'Jawa Barat' => ['Bandung', 'Bogor', 'Depok', 'Cirebon', 'Bekasi'],
            'Jawa Tengah' => ['Semarang', 'Solo', 'Magelang', 'Pekalongan'],
            'Jawa Timur' => ['Surabaya', 'Malang', 'Kediri', 'Madiun'],
            'DKI Jakarta' => ['Jakarta Pusat', 'Jakarta Selatan', 'Jakarta Utara'],
        ];
        // Ambil semua file logo dari assets/mitra/logo/
        $logoFiles = collect(File::files(public_path('assets/mitra/logo')))
            ->filter(function ($file) {
                // Filter hanya file gambar
                return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif']);
            })
            ->shuffle();

        // Pastikan folder storage/app/public/logos/mitra/ ada
        if (!Storage::disk('public')->exists('logos/mitra')) {
            Storage::disk('public')->makeDirectory('logos/mitra');
        }
        foreach ($userIds as $index => $id) {
            $provinsi = fake()->randomElement(array_keys($lokasi));
            $kota = fake()->randomElement($lokasi[$provinsi]);
            // Ambil logo dari assets (cycling jika user lebih banyak dari logo)
            $logoFile = $logoFiles[$index % $logoFiles->count()];
            $logoPath = null;

            if ($logoFile) {
                // Generate nama file unik
                $newFileName = time() . '_' . $index . '_' . $logoFile->getFilename();
                $storagePath = 'logos/mitra/' . $newFileName;

                // Copy file dari assets ke storage
                $sourceFile = $logoFile->getPathname();
                Storage::disk('public')->put($storagePath, File::get($sourceFile));

                $logoPath = $storagePath;
            }
            Mitra::create([
                'nama_mitra' => fake()->company(),
                'deskripsi' => fake()->paragraph(),
                'industri' => fake()->randomElement(['Teknologi', 'Keuangan', 'Kesehatan', 'Pendidikan']),
                'email' => fake()->unique()->companyEmail(),
                'telepon' => fake()->phoneNumber(),
                'website' => fake()->url(),
                'alamat' => fake()->address(),
                'provinsi' => $provinsi,
                'kota' => $kota,
                'logo' => $logoPath,
                'user_id' => $id,
            ]);
        }
    }
}
