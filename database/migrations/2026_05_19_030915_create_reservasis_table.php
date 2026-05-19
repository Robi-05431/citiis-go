<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->integer('jumlah_tiket');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
                'completed'
            ])->default('pending');
            $table->string('kode_booking')->unique();            // kode unik, contoh: RSV-20240101-XXXX
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};