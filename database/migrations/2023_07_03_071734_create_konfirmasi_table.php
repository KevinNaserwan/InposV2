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
        Schema::create('konfirmasi', function (Blueprint $table) {
            $table->string('id_konfirmasi', 50)->primary();
            $table->string('nama_file', 50)->nullable();
            $table->string('nomor_surat', 50);
            $table->string('keterangan', 255)->nullable();
            $table->foreign('nomor_surat')->references('nomor_surat')->on('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasi');
    }
};
