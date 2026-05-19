<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penginapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penginapan');
    }
};