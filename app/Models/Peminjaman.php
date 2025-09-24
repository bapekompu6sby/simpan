<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Peminjaman extends Model
{
    use HasFactory,HasUuids;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = [
        'id_petugas',
        'peminjam',
        'instansi',
        'alamat',
        'no_telp',
        'nip',
        'jabatan',
        'tanggal_pinjam',
        'tanggal_kembali',
        'deskripsi',
        'status',
        'tipe',
        'nama_penandatangan',
        'nip_penandatangan',
        'jabatan_penandatangan',
    ];

    public function detailPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman');
    }
}
