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
        Schema::create('loker_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loker_id')->constrained('lokers')->onDelete('cascade');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->enum('status', ['pending', 'reviewed', 'interview', 'accepted', 'rejected'])->default('pending');
            $table->text('catatan')->nullable(); // Catatan dari mahasiswa saat apply
            $table->text('catatan_mitra')->nullable(); // Catatan dari mitra
            $table->timestamps();

            // Unique constraint: mahasiswa hanya bisa apply 1x per loker
            $table->unique(['loker_id', 'mahasiswa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loker_mahasiswa');
    }
};
