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
        Schema::table('realization_items', function (Blueprint $table) {
            $table->dropForeign('realization_items_plant_id_foreign');
            $table->dropIndex('realization_items_plant_id_foreign');
            $table->dropColumn('plant_id');
        });

        Schema::table('realization_items', function (Blueprint $table) {
            $table->foreignUuid('plant_id')->nullable()->constrained();
            $table->point('location')->nullable()->change();
            $table->string('planting_status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('realization_items', function (Blueprint $table) {
            $table->dropForeign('realization_items_plant_id_foreign');
            $table->dropIndex('realization_items_plant_id_foreign');
            $table->dropColumn('plant_id');
        });

        Schema::table('realization_items', function (Blueprint $table) {
            $table->foreignUuid('plant_id')->constrained()->change();
            $table->point('location')->change();
            $table->string('planting_status')->change();
        });
    }
};
