<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_camping', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_camping_id')->constrained('paket_camping')->onDelete('cascade');
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->integer('jumlah_tamu');
            $table->decimal('total_harga', 12, 2);
            $table->enum('status', [
                'pending',
                'waiting_confirmation',
                'confirmed',
                'cancelled',
                'completed'
            ])->default('pending');
            $table->string('kode_booking')->unique();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_camping');
    }
};