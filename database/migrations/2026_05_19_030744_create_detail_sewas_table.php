<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_sewa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sewa_id')->constrained('sewa_peralatan')->onDelete('cascade');
            $table->foreignId('peralatan_id')->constrained('peralatan')->onDelete('restrict');
            $table->integer('jumlah');
            $table->decimal('harga_satuan', 10, 2);             // snapshot harga saat sewa dilakukan
            $table->decimal('subtotal', 12, 2);                 // jumlah × harga_satuan × jumlah_hari
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_sewa');
    }
};