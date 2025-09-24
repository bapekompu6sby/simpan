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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('id_peminjaman')->primary();
            $table->foreignUuid('id_petugas')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
            $table->string('peminjam', 255);
            $table->string('instansi', 255)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('no_telp', 255)->nullable();
            $table->string('nip', 255)->nullable();
            $table->string('jabatan', 255)->nullable();
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->enum('tipe', ['BMN', 'Kendaraan', 'Laptop'])->default('BMN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
