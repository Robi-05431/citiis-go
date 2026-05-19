<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password_hash');
            $table->string('no_hp')->nullable();
            $table->string('foto_profil')->nullable();
            $table->enum('role', ['wisatawan', 'pengelola', 'admin'])->default('wisatawan');
            $table->enum('status', ['aktif', 'nonaktif', 'suspended'])->default('aktif');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};