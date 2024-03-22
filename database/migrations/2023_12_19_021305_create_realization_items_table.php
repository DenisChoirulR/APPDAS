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
        Schema::create('realization_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('realization_id')->constrained();
            $table->foreignUuid('plant_id')->constrained();
            $table->point('location');
            $table->string('image')->nullable();
            $table->string('planting_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realization_items');
    }
};
