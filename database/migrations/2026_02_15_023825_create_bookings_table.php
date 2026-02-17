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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('psycholog_id')->constrained('psychologs')->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed', 'failed', 'complete', 'cancelled'])->default('pending');
            $table->enum('payment_status', [
                'unpaid',
                'paid',
                'refunded'
            ])->default('unpaid');
            $table->enum('meeting_type', ['online', 'offline'])->default('online');
            $table->decimal('total_price', 12, 2);
            $table->date('session_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('platform_fee', 12, 2);
            $table->decimal('earning', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
