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
        Schema::create('kameras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamera');
            $table->string('merk');
            $table->string('tipe');
            $table->text('spesifikasi');
            $table->integer('stok');
            $table->string('kondisi');
            $table->string('status_ketersediaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kameras');
    }
};
