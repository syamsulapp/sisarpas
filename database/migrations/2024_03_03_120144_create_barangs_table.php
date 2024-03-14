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
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('id_barang')->unique()->primary();
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->string('kondisi_barang');
            $table->enum('kategori_barang', ['barang', 'ruangan']);
            $table->string('detail_barang');
            $table->text('spesifikasi_barang')->nullable();
            $table->string('gambar_barang');
            $table->enum('status_barang', ['ready', 'not-ready', 'maintenance']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
