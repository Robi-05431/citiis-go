<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ikon')->nullable();         // nama icon / path icon
            $table->text('deskripsi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori_wisata');
    }
};