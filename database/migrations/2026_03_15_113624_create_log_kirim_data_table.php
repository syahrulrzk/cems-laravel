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
        if (!Schema::hasTable('log_kirim_data')) {
            Schema::create('log_kirim_data', function (Blueprint $table) {
                $table->id();
                $table->dateTime('date_start')->nullable();
                $table->string('status', 50)->nullable();
                $table->string('log', 110)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_kirim_data');
    }
};
