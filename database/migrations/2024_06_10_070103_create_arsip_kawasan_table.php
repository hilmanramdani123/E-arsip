<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('arsip_kawasan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('nama_surat');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_unggah');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_kawasan');
    }
};
