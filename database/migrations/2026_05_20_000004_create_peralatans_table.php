<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peralatan', function (Blueprint $table) {

            $table->id();

            // RELASI KE TABEL WISATA
            $table->unsignedBigInteger('wisata_id');

            $table->string('nama');

            $table->text('deskripsi')->nullable();

            $table->string('kategori')->nullable();

            $table->decimal('harga_sewa_per_hari', 10, 2);

            $table->integer('total_stok');

            $table->integer('stok_tersedia');

            $table->timestamps();
       
            // FOREIGN KEY
            $table->foreign('wisata_id')
                  ->references('id')
                  ->on('wisata')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peralatan');
    }
};