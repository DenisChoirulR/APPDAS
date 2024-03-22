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
         Schema::create('sub_technical_designs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('technical_design_id')->constrained();
            $table->foreignUuid('work_area_block_id')->constrained();
            $table->foreignUuid('work_area_block_plot_id')->nullable()->constrained()->nullOnDelete();
            $table->string('document_number')->nullable();
            $table->decimal('value_amount', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_technical_designs');
    }
};
