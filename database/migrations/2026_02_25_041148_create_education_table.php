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
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psycholog_id')->constrained('psychologs')->onDelete('cascade');

            $table->string('institution_name'); // Nama Universitas (Contoh: Universitas Tarumanagara)
            $table->string('degree');           // Gelar/Jenjang (Contoh: Sarjana Psikologi atau Magister Profesi)
            $table->string('major')->nullable(); // Penjelasan tambahan (Contoh: Klinis Umum)

            $table->year('graduation_year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
