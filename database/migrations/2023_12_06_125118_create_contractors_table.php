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
        Schema::create('contractors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('company_status_id')->nullable()->constrained()->nullOnDelete();
            $table->string('code');
            $table->string('company_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('deed_of_incorporation');
            $table->string('file_deed_of_incorporation')->nullable();
            $table->string('company_registration_number');
            $table->string('file_company_registration_number')->nullable();
            $table->string('director');
            $table->string('company_type')->nullable();
            $table->string('work_area')->nullable();
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
        Schema::dropIfExists('contractors');
    }
};
