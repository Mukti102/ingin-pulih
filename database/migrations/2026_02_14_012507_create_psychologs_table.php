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
        Schema::create('psychologs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fullname');
            $table->text('about');
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('cascade');
            $table->foreignId('jenis_psikolog')->constrained('types')->onDelete('cascade');
            $table->string('SIPP')->nullable();
            $table->string('STR')->nullable();
            $table->integer('experience_years')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->enum('verification_status',['pending','failed','complete'])->default('pending');
            $table->integer('commision_rate')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychologs');
    }
};
