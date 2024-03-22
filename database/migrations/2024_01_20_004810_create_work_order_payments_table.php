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
        Schema::create('work_order_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('work_order_id')->constrained();
            $table->foreignUuid('realization_id')->nullable()->constrained()->nullOnDelete();
            $table->string('payment_step');
            $table->integer('nominal');
            $table->date('payment_date')->nullable();
            $table->string('payment_status');
            $table->string('work_status');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_order_payments');
    }
};
