<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Profile fields
            $table->string('foto_profil')->nullable()->after('tanggal_lahir');
            $table->text('bio')->nullable()->after('foto_profil');

            // Education, Experience, Skills as JSON
            $table->json('pendidikan')->nullable()->after('bio'); // Array of education
            $table->json('pengalaman')->nullable()->after('pendidikan'); // Array of experiences
            $table->json('skills')->nullable()->after('pengalaman'); // Array of skills

            // Additional contact info as JSON
            $table->json('kontak_tambahan')->nullable()->after('skills'); // github, linkedin, etc

            // Languages
            $table->json('bahasa')->nullable()->after('kontak_tambahan'); // Array of languages
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn([
                'foto_profil',
                'bio',
                'pendidikan',
                'pengalaman',
                'skills',
                'kontak_tambahan',
                'bahasa'
            ]);
        });
    }
};
