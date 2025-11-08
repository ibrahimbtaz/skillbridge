<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\User;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mitra::truncate();
        $userIds = User::where('role', 'mitra')->pluck('id');
        foreach ($userIds as $id) {
            Mitra::create([
                'nama_mitra' => fake()->company(),
                'alamat_mitra' => fake()->address(),
                'no_telp_mitra' => fake()->phoneNumber(),
                'user_id' => $id,
            ]);
        }
    }
}
