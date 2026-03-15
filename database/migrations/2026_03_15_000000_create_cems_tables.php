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
        if (!Schema::hasTable('activity')) {
            Schema::create('activity', function (Blueprint $table) {
                $table->id('activity_id');
                $table->string('activity_title');
                $table->string('activity_cat');
                $table->longText('activity_desc');
                $table->string('activity_status');
                $table->string('activity_from');
                $table->string('activity_to');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('cerobong')) {
            Schema::create('cerobong', function (Blueprint $table) {
                $table->id('cerobong_id');
                $table->string('cerobong_code', 50)->nullable();
                $table->string('cerobong_name');
                $table->string('cerobong_city');
                $table->string('cerobong_status');
                $table->string('cerobong_schedule');
                $table->dateTime('cerobong_from')->nullable();
                $table->dateTime('cerobong_to')->nullable();
                $table->string('cerobong_user');
                $table->tinyInteger('cerobong_kirim_status')->default(1);
            });
        }

        if (!Schema::hasTable('config')) {
            Schema::create('config', function (Blueprint $table) {
                $table->id('config_id');
                $table->string('config_name');
                $table->string('config_value');
            });
        }

        if (!Schema::hasTable('data')) {
            Schema::create('data', function (Blueprint $table) {
                $table->id();
                $table->string('parameter');
                $table->string('value');
                $table->dateTime('waktu');
                $table->string('velocity');
                $table->decimal('laju_alir', 5, 2);
                $table->string('status_gas');
                $table->string('status_partikulat');
                $table->string('status');
                $table->string('fuel');
                $table->decimal('load', 5, 2);
                $table->string('status_sispek');
                $table->integer('cerobong_id');
                $table->dateTime('modified_at');
            });
        }

        if (!Schema::hasTable('notif')) {
            Schema::create('notif', function (Blueprint $table) {
                $table->id('notif_id');
                $table->string('notif_data');
                $table->string('notif_status');
            });
        }

        if (!Schema::hasTable('parameter')) {
            Schema::create('parameter', function (Blueprint $table) {
                $table->id('parameter_id');
                $table->integer('cerobong_id');
                $table->string('parameter_code');
                $table->string('parameter_name');
                $table->string('parameter_threshold');
                $table->string('parameter_portion')->nullable();
                $table->string('parameter_color');
                $table->string('parameter_status');
                $table->string('parameter_sispek', 50)->nullable();
            });
        }

        if (!Schema::hasTable('province')) {
            Schema::create('province', function (Blueprint $table) {
                $table->id('province_id');
                $table->string('province_name');
                $table->string('province_lt');
                $table->string('province_lg');
            });
        }

        if (!Schema::hasTable('temp_table')) {
            Schema::create('temp_table', function (Blueprint $table) {
                $table->id();
                $table->string('temp_parameter');
                $table->dateTime('temp_waktu');
                $table->string('temp_cerobong');
            });
        }

        if (!Schema::hasTable('token')) {
            Schema::create('token', function (Blueprint $table) {
                $table->id();
                $table->text('token')->nullable();
                $table->timestamps();
            });
        }

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
        Schema::dropIfExists('activity');
        Schema::dropIfExists('cerobong');
        Schema::dropIfExists('config');
        Schema::dropIfExists('data');
        Schema::dropIfExists('notif');
        Schema::dropIfExists('parameter');
        Schema::dropIfExists('province');
        Schema::dropIfExists('temp_table');
        Schema::dropIfExists('token');
    }
};
