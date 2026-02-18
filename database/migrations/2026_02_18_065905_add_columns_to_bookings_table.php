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
            $table->json('topics')->nullable();
            $table->boolean('is_followup')->default(false);
            $table->text('problem_description')->nullable();
            $table->text('expectations')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('topics');
            $table->dropColumn('is_followup');
            $table->dropColumn('problem_description');
            $table->dropColumn('expectations');
        });
    }
};
