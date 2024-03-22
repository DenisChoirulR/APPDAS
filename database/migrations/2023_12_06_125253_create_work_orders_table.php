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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('cooperative_contract_id')->constrained();
            $table->foreignUuid('sub_technical_design_id')->constrained();
            $table->string('work_order_number');
            $table->date('work_order_date');
            $table->integer('work_order_value')->default(0);
            $table->string('work_order_document')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
