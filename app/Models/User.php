<?php

namespace App\Models;

// KONSEP OOP: Menggunakan 'use' untuk mengimpor class dari namespace lain.
// Ini adalah prinsip MODULARITAS dalam OOP.
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model User — Merepresentasikan data pengguna dalam sistem.
 *
 * KONSEP OOP:
 * 1. PEWARISAN (Inheritance): Class User mewarisi class 'Authenticatable'
 *    dari Laravel, sehingga mendapatkan semua kemampuan autentikasi
 *    tanpa perlu menulis ulang dari nol.
 * 2. ENKAPSULASI (Encapsulation): Atribut sensitif seperti 'password'
 *    disembunyikan lewat array $hidden agar tidak terekspos.
 */
class User extends Authenticatable
{
    // KONSEP OOP: Penggunaan Trait adalah contoh KOMPOSISI (Composition),
    // sebuah cara menyisipkan kemampuan dari kelas lain tanpa pewarisan langsung.
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     * KONSEP OOP: ENKAPSULASI — hanya kolom yang terdaftar di sini yang
     * dapat dimodifikasi, melindungi data dari manipulasi yang tidak diinginkan.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model dikonversi ke array/JSON.
     * KONSEP OOP: ENKAPSULASI — menyembunyikan data sensitif dari dunia luar.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data otomatis.
     * KONSEP OOP: ABSTRAKSI — kita tidak perlu pusing mengkonversi tipe data secara manual.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // =========================================================================
    // METHOD BISNIS (Business Methods) — Perilaku dari Objek User
    // KONSEP OOP: Sebuah objek memiliki DATA (atribut) dan PERILAKU (method).
    // =========================================================================

    /**
     * Memeriksa apakah pengguna memiliki peran sebagai Admin.
     * KONSEP OOP: ENKAPSULASI — logika pengecekan peran disimpan di dalam class,
     * bukan tersebar di seluruh kode aplikasi.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Mendapatkan inisial nama pengguna untuk ditampilkan sebagai avatar teks.
     * KONSEP OOP: METHOD sebagai perilaku objek yang mengolah data miliknya sendiri.
     */
    public function getInitials(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }

    // =========================================================================
    // RELASI (Relationships) — Hubungan Antar Objek
    // KONSEP OOP: Ini merepresentasikan ASOSIASI antar class/objek dalam sistem.
    // =========================================================================

    /**
     * Seorang User memiliki banyak LogoutLog.
     * KONSEP OOP: ASOSIASI "has-many" antara objek User dan objek LogoutLog.
     */
    public function logoutLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LogoutLog::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    /**
     * Mengecek apakah pengguna adalah User biasa (Customer).
     */
    public function isUser(): bool
    {
        return $this->role === 'customer';
    }
}
