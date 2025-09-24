<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class DetailPeminjaman extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id_detailpeminjaman';
    protected $fillable = ['idpeminjaman, id_barang, lokasi_awal, lokasi_akhir, deskripsi'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
