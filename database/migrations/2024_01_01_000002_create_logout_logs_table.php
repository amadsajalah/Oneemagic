<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk membuat tabel log keluar pengguna.
 * 
 * KONSEP OOP: Pewarisan (Inheritance) dari class Migration.
 * Tabel ini adalah implementasi SOLID — Single Responsibility Principle:
 * satu tabel hanya bertanggung jawab mencatat satu hal (data logout).
 */
return new class extends Migration
{
    /**
     * Menjalankan migrasi — membuat tabel 'logout_logs'.
     */
    public function up(): void
    {
        Schema::create('logout_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')                          // Foreign key ke tabel users
                  ->constrained()
                  ->onDelete('cascade');
            $table->string('ip_address', 45)->nullable();        // Alamat IP pengguna saat logout
            $table->timestamp('logged_out_at');                  // Waktu logout yang tepat
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('logout_logs');
    }
};
