<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen');
            $table->string('nama_dokumen');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_unggah');
            $table->string('file_path');
            $table->unsignedBigInteger('user_id'); // Kolom user_id untuk relasi dengan tabel users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relasi foreign key ke tabel users
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
