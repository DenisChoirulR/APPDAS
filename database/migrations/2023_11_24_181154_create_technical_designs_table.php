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
        Schema::create('technical_designs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid('das_project_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignUuid('work_area_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_designs');
    }
};
