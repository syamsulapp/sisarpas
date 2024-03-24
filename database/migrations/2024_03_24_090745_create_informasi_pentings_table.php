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
        Schema::create('informasi_pentings', function (Blueprint $table) {
            $table->id();
            $table->string('judul_informasi');
            $table->text('isi_informasi');
            $table->string('gambar_informasi');
            $table->enum('status', ['hide', 'unhide']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_pentings');
    }
};
