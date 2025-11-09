<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


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
        $logos = collect(File::files(public_path('assets/mitra/logo')))
        ->map(fn($file) => 'assets/mitra/logo/' . $file->getFilename())
        ->shuffle();
        foreach ($userIds as $id) {
            $provinsi = fake()->randomElement(array_keys($lokasi));
            $kota = fake()->randomElement($lokasi[$provinsi]);
            $logo = $logos->shift();
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
                'logo' => $logo,
                'user_id' => $id,
            ]);
        }
    }
}
