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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('jurusan')->nullable();
            $table->string('semester')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('foto_profil')->nullable();
            $table->text('bio')->nullable();
            $table->json('pendidikan')->nullable(); // Array of education
            $table->json('pengalaman')->nullable(); // Array of experiences
            $table->json('skills')->nullable(); // Array of skills
            $table->json('kontak_tambahan')->nullable(); // github, linkedin, etc
            $table->json('bahasa')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
