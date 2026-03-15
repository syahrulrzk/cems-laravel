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
        Schema::table('data', function (Blueprint $table) {
            $table->index('parameter');
            $table->index('cerobong_id');
            $table->index('waktu');
        });
    }

    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            $table->dropIndex(['parameter']);
            $table->dropIndex(['cerobong_id']);
            $table->dropIndex(['waktu']);
        });
    }
};
