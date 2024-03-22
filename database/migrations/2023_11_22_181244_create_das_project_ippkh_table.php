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
        Schema::create('das_project_ippkh', function (Blueprint $table) {
            $table->foreignUuid('das_project_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('ippkh_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('das_project_ippkh');
    }
};
