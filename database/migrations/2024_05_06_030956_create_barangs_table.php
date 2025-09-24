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
        Schema::create('barang', function (Blueprint $table) {
            $table->uuid('id_barang')->primary();
            $table->foreignUuid('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->string('kode_satker',255);
            $table->string('nama_satker',255);
            $table->string('kode_barang',255);
            $table->string('nama_barang',255);
            $table->integer('nup');
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->string('merek',255);
            $table->string('tipe',255);
            $table->date('tanggal_perolehan',255);
            $table->date('tanggal_awal_pakai',255);
            $table->float('nilai_perolehan_pertama');
            $table->float('nilai_mutasi');
            $table->float('nilai_perolehan');
            $table->float('nilai_penyusutan');
            $table->float('nilai_buku');
            $table->integer('kuantitas');
            $table->integer('jumlah_foto');
            $table->text('status_penggunaan');
            $table->string('no_psp',50);
            $table->date('tanggal_psp');
            $table->string('no_bpkb',255)->nullable();
            $table->string('no_polisi',255)->nullable();
            $table->string('no_tiket_usul_psp',255)->nullable();
            $table->enum('intra_ekstra', ['Intrakomptabel', 'Ekstrakomptabel'])->default('Intrakomptabel')->nullable();
            $table->enum('status_bpybds', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_henti_guna', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_kemitraan', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_barang_hilang', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_barang_dktp', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_usul_rusak_berat', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->enum('status_usul_hapus', ['Tidak', 'Ada'])->default('Tidak')->nullable();
            $table->integer('sisa_umur')->nullable();
            $table->enum('status_sakti', ['Tidak', 'Ada'])->default('Ada')->nullable();
            $table->string('kode_register_sakti',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
