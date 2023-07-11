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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->string('id_disposisi', 50)->primary();
            $table->string('perihal', 50)->nullable();
            $table->string('catatan', 50)->nullable();
            $table->integer('status')->nullable();
            $table->string('nomor_surat', 50);
            $table->string('divisi', 50)->nullable();
            $table->foreign('nomor_surat')->references('nomor_surat')->on('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
