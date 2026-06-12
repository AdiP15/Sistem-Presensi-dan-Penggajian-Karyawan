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
        Schema::create('gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('bulan'); // Contoh: Januari
            $table->year('tahun');   // Contoh: 2026
            $table->decimal('gaji_pokok', 12, 2);
            $table->decimal('total_tunjangan', 12, 2)->default(0);
            $table->decimal('potongan', 12, 2)->default(0); // Telat/Alpha
            $table->decimal('total_gaji', 12, 2); // Take home pay
            $table->enum('status_pembayaran', ['pending', 'lunas'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gajis');
    }
};
