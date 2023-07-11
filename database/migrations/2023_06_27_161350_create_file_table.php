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
        Schema::create('file', function (Blueprint $table) {
            $table->string('nomor_surat', 50)->primary();
            $table->string('nama_file', 50)->nullable();
            $table->timestamp('tanggal')->nullable();
            $table->string('id_pos', 20);
            $table->string('file_pdf', 255)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->foreign('id_pos')->references('id_pos')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file');
    }
};
