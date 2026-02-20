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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // Relasi ke booking
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');

            // Data dari Midtrans
            $table->string('transaction_id')->nullable(); // ID unik dari Midtrans
            $table->string('reference_id')->unique();     // Kode booking kita (BRN-xxx)
            $table->string('payment_type')->nullable();    // gopay, bank_transfer, dll
            $table->string('snap_token')->nullable();     // Token untuk popup Snap

            // Nominal
            $table->decimal('amount', 12, 2);

            // Status (Sinkron dengan Midtrans)
            // pending, settlement (berhasil), expire, cancel, deny
            $table->string('status')->default('pending');

            // Log teknis (Opsional tapi berguna untuk debug)
            $table->json('payload_notification')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
