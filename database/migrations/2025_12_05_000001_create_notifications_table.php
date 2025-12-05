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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'lamaran_baru', 'status_lamaran', dll
            $table->string('title');
            $table->text('message');
            $table->string('icon')->nullable(); // icon class (fa-briefcase, dll)
            $table->string('color')->default('blue'); // blue, green, red, yellow
            $table->string('link')->nullable(); // URL tujuan saat diklik
            $table->json('data')->nullable(); // data tambahan (loker_id, mahasiswa_id, dll)
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'read_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
