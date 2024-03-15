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
        Schema::create('barangpinjams', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('barangs_id')->references('id')->on('barangs');
            $table->foreignId('users_id')->references('id')->on('users');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pengembalian')->nullable(); //event verification by admin
            $table->string('kategori_pinjam');
            $table->string('tujuan_pinjam');
            $table->string('keterangan_pinjam');
            $table->string('dokumen_pendukung');
            $table->enum('status_pinjam', ['diajkukan', 'ditolak', 'dipinjam', 'dikembalikan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangpinjams');
    }
};
