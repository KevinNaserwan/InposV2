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
        Schema::create('outgoing', function (Blueprint $table) {
            $table->string('nomor_surat', 50)->primary();
            $table->timestamp('tanggal')->nullable();
            $table->string('id_pos', 20);
            $table->integer('level')->nullable();
            $table->integer('divisi')->nullable();
            $table->string('perihal', 255)->nullable();
            $table->string('isi_surat', 10000)->nullable();
            $table->string('tujuan', 255)->nullable();
            $table->string('lampiran', 255)->nullable();
            $table->integer('status')->nullable();
            $table->foreign('id_pos')->references('id_pos')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outgoing');
    }
};
