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
            $table->string('name_barang');
            $table->string('condition_barang');
            $table->enum('status_barang', ['ready', 'not-ready']);
            $table->string('specification_barang');
            $table->string('stock_barang');
            $table->string('img_barang');
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
