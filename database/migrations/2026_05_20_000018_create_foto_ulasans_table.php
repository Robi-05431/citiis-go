<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foto_ulasan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ulasan_id')->constrained('ulasan')->onDelete('cascade');
            $table->string('url_foto');
            $table->timestamp('uploaded_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_ulasan');
    }
};