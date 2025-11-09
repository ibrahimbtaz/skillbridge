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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->text('deskripsi')->nullable(); // Deskripsi Perusahaan
            $table->string('industri')->nullable(); // Industri (Tech, Finance, etc)
            $table->string('email')->unique(); // Email Perusahaan
            $table->string('telepon')->nullable(); // Nomor Telepon
            $table->string('website')->nullable(); // Website Perusahaan
            $table->text('alamat')->nullable(); // Alamat Perusahaan
            $table->string('provinsi')->nullable(); // Provinsi
            $table->string('kota')->nullable(); // Kota
            $table->string('logo')->nullable(); // Logo Perusahaan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->softDeletes(); // Soft Delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
