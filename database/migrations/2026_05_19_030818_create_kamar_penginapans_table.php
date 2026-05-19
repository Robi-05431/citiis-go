<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamar_penginapan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penginapan_id')->constrained('penginapan')->onDelete('cascade');
            $table->string('tipe_kamar');                        // Deluxe, Standard, Suite, dll
            $table->text('deskripsi')->nullable();
            $table->integer('kapasitas');
            $table->decimal('harga_per_malam', 10, 2);
            $table->integer('total_kamar');
            $table->boolean('tersedia')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamar_penginapan');
    }
};