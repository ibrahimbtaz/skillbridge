<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $users = [
            [
                'name' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => '3',
            ],
            [
                'name' => 'mitra',
                'email' => 'mitra@example.com',
                'password' => Hash::make('password'),
                'role' => '2',
            ],
        ];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'name' => now()->format('ymdHis').strtoupper(Str::random(4)),
                'email' => fake()->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => '3',
            ];
        }
        for ($i = 0; $i < 2; $i++) {
            $users[] = [
                'name' => now()->format('mdHis').strtoupper(Str::random(4)),
                'email' => fake()->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => '2',
            ];
        }
        User::insert($users);
    }
}
