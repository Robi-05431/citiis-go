<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();

            // Polymorphic reference: bisa untuk reservasi, booking_camping,
            // booking_penginapan, atau sewa_peralatan
            $table->enum('ref_type', [
                'reservasi',
                'booking_camping',
                'booking_penginapan',
                'sewa_peralatan'
            ]);
            $table->unsignedBigInteger('ref_id');               // ID dari tabel yang dirujuk

            $table->string('metode')->nullable();               // transfer, qris, va, dll
            $table->decimal('jumlah', 12, 2);
            $table->enum('status', [
                'pending',
                'success',
                'failed',
                'expired',
                'refunded'
            ])->default('pending');
            $table->string('kode_transaksi')->nullable()->unique(); // kode dari payment gateway
            $table->string('payment_url')->nullable();          // URL redirect ke halaman bayar
            $table->timestamp('expired_at')->nullable();        // kapan link pembayaran expired
            $table->timestamp('paid_at')->nullable();           // kapan dibayar
            $table->timestamp('created_at')->useCurrent();

            // Index untuk polymorphic lookup
            $table->index(['ref_type', 'ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};