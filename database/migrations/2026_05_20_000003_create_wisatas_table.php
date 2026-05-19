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

            $table->foreignId('pengelola_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('kategori_id')
                ->constrained('kategori_wisata')
                ->cascadeOnDelete();

            $table->string('nama');

            $table->text('deskripsi')->nullable();

            $table->text('alamat')->nullable();

            $table->decimal('harga_tiket', 10, 2)->default(0);

            $table->integer('kuota_harian')->default(0);

            $table->decimal('latitude', 10, 7)->nullable();

            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('thumbnail')->nullable();

            $table->enum('status', [
                'draft',
                'published',
                'nonaktif'
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};