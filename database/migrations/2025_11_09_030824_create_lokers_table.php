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
        // lowongan kerja
        Schema::create('lokers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->enum('jenis_kerja', ['fulltime', 'parttime', 'freelance', 'contract'])->default('fulltime');
            $table->enum('tipe_kerja', ['onsite', 'remote', 'hybrid'])->default('onsite');
            $table->integer('gaji_min')->nullable(); // Gaji Minimum
            $table->integer('gaji_max')->nullable(); // Gaji Maximum
            $table->text('tanggung_jawab')->nullable(); // Tanggung Jawab
            $table->text('kualifikasi')->nullable(); // Persyaratan/Qualifikasi
            $table->text('benefits')->nullable(); // Benefit/Tunjangan
            $table->enum('status', ['draft', 'published', 'closed', 'filled'])->default('draft');
            $table->timestamp('deadline')->nullable(); // Batas Waktu Lamaran
            $table->foreignId('mitra_id')->constrained()->onDelete('cascade');
            $table->softDeletes(); // Soft Delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokers');
    }
};
