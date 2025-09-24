<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->uuid('id_pengguna')->primary();
            $table->string('username',255)->unique();
            $table->string('nama',255);
            $table->string('nip',50);
            $table->string('email',32)->unique();
            $table->string('password',255);
            $table->enum('role', ['Admin', 'Petugas'])->default('Petugas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
