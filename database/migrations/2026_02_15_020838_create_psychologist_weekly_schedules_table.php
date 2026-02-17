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
        Schema::create('psychologist_weekly_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psycholog_id')
                ->constrained('psychologs')
                ->onDelete('cascade');

            $table->enum('day_of_week', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ]);

            $table->time('start_time');
            $table->time('end_time');

            $table->boolean('is_active')->default(true);


            $table->unique(['psycholog_id', 'day_of_week']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychologist_weekly_schedules');
    }
};
