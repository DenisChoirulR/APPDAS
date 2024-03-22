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
        Schema::table('cooperative_contracts', function (Blueprint $table) {
            $table->string('document')->nullable()->after('contract_date');
            $table->integer('down_payment')->default(0)->after('document');
            $table->integer('p0_payment')->default(0)->after('down_payment');
            $table->integer('p1_payment')->default(0)->after('p0_payment');
            $table->integer('p2_payment')->default(0)->after('p1_payment');
            $table->integer('security_deposit')->default(0)->after('p2_payment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cooperative_contracts', function (Blueprint $table) {
            $table->dropColumn('document');
            $table->dropColumn('down_payment');
            $table->dropColumn('p0_payment');
            $table->dropColumn('p1_payment');
            $table->dropColumn('p2_payment');
            $table->dropColumn('security_deposit');
        });
    }
};
