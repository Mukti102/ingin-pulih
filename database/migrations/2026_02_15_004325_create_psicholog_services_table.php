<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psicholog_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psycholog_id')->constrained('psychologs')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->decimal('price', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->unique(['psycholog_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psicholog_services');
    }
};
