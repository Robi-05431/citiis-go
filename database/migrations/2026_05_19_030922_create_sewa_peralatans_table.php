<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sewa_peralatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('total_harga', 12, 2)->default(0); // dihitung dari detail_sewa
            $table->enum('status', [
                'pending',
                'confirmed',
                'active',        // sedang disewa
                'returned',      // sudah dikembalikan
                'cancelled'
            ])->default('pending');
            $table->string('kode_sewa')->unique();              // kode unik sewa, contoh: SWA-20240101-XXXX
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sewa_peralatan');
    }
};