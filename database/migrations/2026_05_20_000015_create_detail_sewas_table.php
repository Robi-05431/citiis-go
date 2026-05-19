<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Schema::create('detail_sewas', function (Blueprint $table) {

        //     $table->id();

        //     $table->foreignId('sewa_id')
        //           ->constrained('sewa_peralatans')
        //           ->onDelete('cascade');

        //     $table->foreignId('peralatan_id')
        //           ->constrained('peralatans')
        //           ->onDelete('restrict');

        //     $table->integer('jumlah');

        //     $table->decimal('harga_satuan', 10, 2);

        //     $table->decimal('subtotal', 12, 2);

        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_sewas');
    }
};