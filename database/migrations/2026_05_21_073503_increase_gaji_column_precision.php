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
        Schema::table('gajis', function (Blueprint $table) {
            $table->decimal('gaji_pokok', 15, 2)->default(0)->change();
            $table->decimal('uang_makan', 15, 2)->default(0)->change();
            $table->decimal('uang_transport', 15, 2)->default(0)->change();
            $table->decimal('uang_lembur', 15, 2)->default(0)->change();
            $table->decimal('potongan', 15, 2)->default(0)->change();
            $table->decimal('denda_keterlambatan', 15, 2)->default(0)->change();
            $table->decimal('total_gaji', 15, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gajis', function (Blueprint $table) {
            $table->decimal('gaji_pokok', 12, 2)->default(0)->change();
            $table->decimal('uang_makan', 12, 2)->default(0)->change();
            $table->decimal('uang_transport', 12, 2)->default(0)->change();
            $table->decimal('uang_lembur', 12, 2)->default(0)->change();
            $table->decimal('potongan', 12, 2)->default(0)->change();
            $table->decimal('denda_keterlambatan', 12, 2)->default(0)->change();
            $table->decimal('total_gaji', 12, 2)->default(0)->change();
        });
    }
};
