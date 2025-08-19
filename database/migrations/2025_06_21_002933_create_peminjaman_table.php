<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->nullOnDelete();
            $table->foreignId('buku_id')->nullable()->constrained('buku')->nullOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
