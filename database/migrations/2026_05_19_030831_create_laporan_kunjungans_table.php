<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->foreignId('pengelola_id')->constrained('users')->onDelete('cascade');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->integer('total_kunjungan')->default(0);
            $table->decimal('total_pendapatan', 15, 2)->default(0);
            $table->timestamp('generated_at')->useCurrent();
            $table->enum('format', ['json', 'file'])->default('json');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_kunjungan');
    }
};