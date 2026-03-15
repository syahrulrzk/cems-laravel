<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data', function (Blueprint $table) {
            $table->foreign('cerobong_id')
                ->references('cerobong_id')
                ->on('cerobong')
                ->onDelete('cascade');
        });

        Schema::table('parameter', function (Blueprint $table) {
            $table->foreign('cerobong_id')
                ->references('cerobong_id')
                ->on('cerobong')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('data', function (Blueprint $table) {
            $table->dropForeign(['cerobong_id']);
        });

        Schema::table('parameter', function (Blueprint $table) {
            $table->dropForeign(['cerobong_id']);
        });
    }
};
