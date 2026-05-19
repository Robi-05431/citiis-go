<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_camping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->string('nama_paket');
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_per_malam', 10, 2);
            $table->integer('kapasitas_tamu');
            $table->integer('total_slot');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->boolean('tersedia')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_camping');
    }
};