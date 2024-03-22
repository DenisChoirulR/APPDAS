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
        Schema::table('work_orders', function (Blueprint $table) {
            $table->bigInteger('work_order_value')->change()->default(0);
        });

        Schema::table('work_order_payments', function (Blueprint $table) {
            $table->bigInteger('nominal')->change()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->integer('work_order_value')->change()->default(0);
        });

        Schema::table('work_order_payments', function (Blueprint $table) {
            $table->integer('nominal')->change()->default(0);
        });
    }
};
