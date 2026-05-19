<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengelola_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategori_wisata')->onDelete('restrict');
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('alamat');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->decimal('harga_tiket', 10, 2)->default(0);
            $table->integer('kuota_harian')->default(0);
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('aktif');
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};