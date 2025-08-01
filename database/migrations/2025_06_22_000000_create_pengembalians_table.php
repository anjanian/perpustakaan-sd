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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->date('tanggal_kembali');
            $table->date('tanggal_pengembalian');
            $table->string('status'); // Dikembalikan, terlambat, Hilang, Rusak
            $table->decimal('denda', 10, 2)->nullable()->default(0.00);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->softDeletes(); // BARIS INI DITAMBAHKAN untuk fitur soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};