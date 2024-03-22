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
        Schema::create('work_area_block_plots', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('work_area_block_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('planting_pattern_id')->nullable()->constrained()->nullOnDelete();
            $table->string('plot');
            $table->decimal('plot_size', 10)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_area_block_plots');
    }
};
