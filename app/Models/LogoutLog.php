<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model LogoutLog — Merepresentasikan data log logout pengguna.
 *
 * KONSEP OOP:
 * 1. PEWARISAN (Inheritance): Mewarisi class Model dari Eloquent ORM.
 * 2. ENKAPSULASI: Menentukan kolom apa saja yang bisa diisi ($fillable).
 */
class LogoutLog extends Model
{
    use HasFactory;

    /**
     * Menonaktifkan kolom `updated_at` karena log hanya dibuat, tidak diupdate.
     * KONSEP OOP: Overriding sifat bawaan class induk (Model).
     */
    public const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'ip_address',
        'logged_out_at',
    ];

    /**
     * Mendefinisikan bahwa atribut 'logged_out_at' adalah tipe datetime.
     */
    protected function casts(): array
    {
        return [
            'logged_out_at' => 'datetime',
        ];
    }

    // =========================================================================
    // RELASI (Relationships)
    // =========================================================================

    /**
     * Sebuah LogoutLog dimiliki oleh seorang User.
     * KONSEP OOP: ASOSIASI "belongs-to" (ketergantungan struktural).
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
