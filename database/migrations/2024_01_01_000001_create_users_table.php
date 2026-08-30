<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration untuk membuat tabel pengguna.
 * 
 * KONSEP OOP: Class ini mewarisi (extends) class Migration dari Laravel.
 * Ini adalah contoh PEWARISAN (Inheritance), salah satu pilar utama OOP.
 */
return new class extends Migration
{
    /**
     * Menjalankan migrasi — membuat tabel 'users'.
     * 
     * KONSEP OOP: Method up() adalah ENKAPSULASI dari logika pembuatan tabel.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                                          // Primary Key
            $table->string('name');                               // Nama lengkap
            $table->string('email')->unique();                    // Email (unik)
            $table->string('password');                           // Kata sandi (hashed)
            $table->enum('role', ['admin', 'customer'])              // Peran pengguna
                  ->default('customer');
            $table->rememberToken();                              // Token "Ingat Saya"
            $table->timestamps();                                  // created_at & updated_at
        });
    }

    /**
     * Membatalkan migrasi — menghapus tabel 'users'.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
