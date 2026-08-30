<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fix payment_status enum to include 'pending'
        DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status ENUM('unpaid','pending','verifying','paid','failed') DEFAULT 'unpaid'");

        // Tambah kolom refund
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('refund_status', ['requested', 'approved', 'rejected'])->nullable()->after('payment_status');
            $table->text('refund_reason')->nullable()->after('refund_status');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['refund_status', 'refund_reason']);
        });
        DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status ENUM('unpaid','verifying','paid','failed') DEFAULT 'unpaid'");
    }
};
