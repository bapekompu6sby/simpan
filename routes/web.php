<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenandatanganController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\CekLogin;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isAdmin;

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware(isLogin::class);
Route::post('/', [LoginController::class, 'authlogin'])->name('auth.login')->middleware(isLogin::class);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware([CekLogin::class])->group(function () {
    Route::get('/administrator', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Kategori
    Route::get('/administrator/kategori', [KategoriController::class, 'index'])->name('admin.data.kategori');
    Route::post('/administrator/kategori', [KategoriController::class, 'insert']);
    Route::post('/administrator/kategori/update', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::get('/administrator/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.delete');

    // Asset
    Route::get('/administrator/aset', [AsetController::class, 'index'])->name('admin.data.aset');
    Route::get('/administrator/aset/detail/{id}', [AsetController::class, 'show'])->name('admin.detail.aset');
    Route::get('/administrator/aset/delete/{id}', [AsetController::class, 'destroy'])->name('admin.aset.delete');
    Route::get('/administrator/aset/kategori/{slug}', [AsetController::class, 'showByKategori'])->name('admin.data.aset.kategori');
    Route::post('/administrator/aset/get-nup', [AsetController::class, 'getNupByName'])->name('admin.aset.get.nup');
    Route::post('/administrator/aset/get-nopolisi', [AsetController::class, 'getNoPolisiByMerek'])->name('admin.aset.get.nopolisi');
    Route::get('/administrator/aset/import', [AsetController::class, 'viewImport'])->name('admin.import.aset');
    Route::post('/administrator/aset/import', [AsetController::class, 'import']);
    Route::get('/administrator/aset/export/', [AsetController::class, 'export'])->name('admin.aset.export');
    Route::get('/administrator/aset/export/kategori/{slug}', [AsetController::class, 'exportByKategori'])->name('admin.aset.export.by.kategori');

    // Lokasi
    Route::post('/administrator/lokasi/set', [LokasiController::class, 'store'])->name('admin.lokasi.set');
    Route::get('/administrator/get-lokasi/{id}', [LokasiController::class, 'show'])->name('admin.lokasi.get');

    // Peminjaman
    Route::get('/administrator/peminjaman', [PeminjamanController::class, 'index'])->name('admin.peminjaman');
    Route::get('/administrator/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('admin.peminjaman.tambah');
    Route::post('/administrator/peminjaman/tambah', [PeminjamanController::class, 'store'])->name('admin.peminjaman.store');
    Route::get('/administrator/peminjaman/tambah/kendaraan', [PeminjamanController::class, 'createKendaraan'])->name('admin.peminjaman.tambah-kendaraan');
    Route::post('/administrator/peminjaman/tambah/kendaraan', [PeminjamanController::class, 'storeKendaraan'])->name('admin.peminjaman.store-kendaraan');
    Route::get('/administrator/peminjaman/tambah/laptop', [PeminjamanController::class, 'createLaptop'])->name('admin.peminjaman.tambah-laptop');
    Route::post('/administrator/peminjaman/tambah/laptop', [PeminjamanController::class, 'storeLaptop'])->name('admin.peminjaman.store-laptop');
    Route::get('/administrator/peminjaman/status/{id}', [PeminjamanController::class, 'status'])->name('admin.update.status');
    Route::get('/administrator/peminjaman/delete/{id}', [PeminjamanController::class, 'destroy'])->name('admin.peminjaman.delete');
    Route::get('/administrator/peminjaman/detail/{id}', [PeminjamanController::class, 'show'])->name('admin.peminjaman.detail');
    Route::get('/administrator/peminjaman/print/{id}', [PeminjamanController::class, 'printPdf'])->name('admin.peminjaman.print');

    // Laporan
    Route::get('/administrator/laporan', [PeminjamanController::class, 'laporan'])->name('admin.laporan');
    Route::get('/administrator/laporan/export', [PeminjamanController::class, 'export'])->name('admin.laporan.export');

    // Pengguna
    Route::get('/administrator/pengguna', [PenggunaController::class, 'index'])->name('admin.data.pengguna')->middleware(isAdmin::class);
    Route::post('/administrator/pengguna', [PenggunaController::class, 'store'])->middleware(isAdmin::class);
    Route::post('/administrator/pengguna/update', [PenggunaController::class, 'update'])->name('admin.pengguna.update')->middleware(isAdmin::class);
    Route::get('/administrator/pengguna/delete/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.delete')->middleware(isAdmin::class);

    // Penandatangan
    Route::get('/administrator/penandatangan', [PenandatanganController::class, 'index'])->name('admin.penandatangan')->middleware(isAdmin::class);
    Route::post('/administrator/penandatangan', [PenandatanganController::class, 'store'])->middleware(isAdmin::class);
    Route::post('/administrator/penandatangan/update', [PenandatanganController::class, 'update'])->name('admin.penandatangan.update')->middleware(isAdmin::class);
    Route::get('/administrator/penandatangan/delete/{id}', [PenandatanganController::class, 'destroy'])->name('admin.penandatangan.delete')->middleware(isAdmin::class);
});