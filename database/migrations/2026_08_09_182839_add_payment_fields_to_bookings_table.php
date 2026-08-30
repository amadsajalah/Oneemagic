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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->nullable()->after('status');
            $table->string('payment_proof')->nullable()->after('price');
            $table->enum('payment_status', ['unpaid', 'verifying', 'paid', 'failed'])->default('unpaid')->after('payment_proof');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['price', 'payment_proof', 'payment_status']);
        });
    }
};
