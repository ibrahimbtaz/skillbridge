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
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelatihan'); // Nama Pelatihan
            $table->text('deskripsi'); // Deskripsi Pelatihan
            $table->string('kategori'); // Kategori (Programming, Design, Business, etc)
            $table->string('thumbnail')->nullable(); // Gambar Thumbnail
            $table->decimal('rating', 3, 2)->default(0); // Rating (0-5)
            $table->json('tags')->nullable(); // Tags (JSON Array)
            $table->json('persyaratan')->nullable(); // Persyaratan Peserta
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
        Schema::dropIfExists('pelatihans');
    }
};
