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
        Schema::create('session_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_meet_id')->constrained('session_meets')->onDelete('cascade');
            $table->string('room_code')->nullable();
            $table->enum('provider', ['zoom', 'google meet']);
            $table->string('meeting_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_rooms');
    }
};
