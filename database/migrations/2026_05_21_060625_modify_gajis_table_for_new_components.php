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
            $table->dropColumn('total_tunjangan');
            $table->integer('total_hari_hadir')->default(0)->after('gaji_pokok');
            $table->decimal('uang_makan', 12, 2)->default(0)->after('total_hari_hadir');
            $table->decimal('uang_transport', 12, 2)->default(0)->after('uang_makan');
            $table->decimal('uang_lembur', 12, 2)->default(0)->after('uang_transport');
            $table->decimal('denda_keterlambatan', 12, 2)->default(0)->after('potongan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gajis', function (Blueprint $table) {
            $table->decimal('total_tunjangan', 12, 2)->default(0)->after('gaji_pokok');
            $table->dropColumn(['total_hari_hadir', 'uang_makan', 'uang_transport', 'uang_lembur', 'denda_keterlambatan']);
        });
    }
};
