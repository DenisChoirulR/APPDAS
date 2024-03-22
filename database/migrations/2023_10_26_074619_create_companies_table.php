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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_status_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('secondary_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('deed_of_incorporation')->nullable();
            $table->string('file_deed_of_incorporation')->nullable();
            $table->string('company_status')->nullable();
            $table->string('tax_identification_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
