<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\Barang;

class AsetImport implements ToCollection, WithHeadingRow
{
    private $id_kategori;

    public function __construct($id_kategori)
    {
        $this->id_kategori = $id_kategori;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $rows) {
            if (empty($rows['kode_satker'])) {
                continue;
            }

            if (isset($rows['kode_register_sakti']) && !empty($rows['kode_register_sakti'])) {
                Barang::updateOrCreate(
                    ['kode_register_sakti' => $rows['kode_register_sakti']],
                    [
                        'id_kategori' => $this->id_kategori,
                        'kode_satker' => $rows['kode_satker'],
                        'nama_satker' => $rows['nama_satker'],
                        'kode_barang' => $rows['kode_barang'],
                        'nama_barang' => $rows['nama_barang'],
                        'nup' => $rows['nup'],
                        'kondisi' => $rows['kondisi'],
                        'merek' => $rows['merek'] ?? $rows['merktipe'],
                        'tipe' => $rows['tipe'] ?? $rows['merktipe'],
                        'no_bpkb'       => $rows['no_bpkb'] ?? null,
                        'no_polisi'     => $rows['no_polisi'] ?? null,
                        'tanggal_perolehan' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_perolehan'])),
                        'tanggal_awal_pakai' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_awal_pakai'] ?? $rows['tgl_rekam_pertama'])),
                        'nilai_perolehan_pertama' => $rows['nilai_perolehan_pertama'],
                        'nilai_mutasi' => $rows['nilai_mutasi'],
                        'nilai_perolehan' => $rows['nilai_perolehan'],
                        'nilai_penyusutan' => $rows['nilai_penyusutan'],
                        'nilai_buku' => $rows['nilai_buku'],
                        'kuantitas' => $rows['kuantitas'],
                        'jumlah_foto' => $rows['jml_foto'],
                        'status_penggunaan' => $rows['status_penggunaan'],
                        'no_psp' => $rows['no_psp'],
                        'tanggal_psp' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_psp'])),
                        'no_tiket_usul_psp' => $rows['no_tiket_usul_psp'] ?? null,
                        'intra_ekstra' => $rows['intraekstra'] ?? null,
                        'status_bpybds' => $rows['status_bpybds'] ?? null,
                        'status_henti_guna' => $rows['status_henti_guna'] ?? null,
                        'status_kemitraan' => $rows['status_kemitraan'] ?? null,
                        'status_barang_hilang' => $rows['status_barang_hilang'] ?? null,
                        'status_barang_dktp' => $rows['status_barang_dktp'] ?? null,
                        'status_usul_rusak_berat' => $rows['status_usul_rusak_berat'] ?? null,
                        'status_usul_hapus' => $rows['status_usul_hapus'] ?? null,
                        'sisa_umur' => $rows['sisa_umur_semester'] ?? null,
                        'status_sakti' => $rows['status_sakti'] ?? null,
                    ],
                );
            } else {
                Barang::create([
                    'id_kategori'   => $this->id_kategori,
                    'kode_satker'   => $rows['kode_satker'],
                    'nama_satker'   => $rows['nama_satker'],
                    'kode_barang'   => $rows['kode_barang'],
                    'nama_barang'   => $rows['nama_barang'],
                    'nup'           => $rows['nup'],
                    'kondisi'       => $rows['kondisi'],
                    'merek'         => $rows['merek'] ?? $rows['merktipe'],
                    'tipe'          => $rows['tipe'] ?? $rows['merktipe'],
                    'no_bpkb'       => $rows['no_bpkb'] ?? null,
                    'no_polisi'     => $rows['no_polisi'] ?? null,
                    'tanggal_perolehan' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_perolehan'])),
                    'tanggal_awal_pakai' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_awal_pakai'] ?? $rows['tgl_rekam_pertama'])),
                    'nilai_perolehan_pertama' => $rows['nilai_perolehan_pertama'],
                    'nilai_mutasi' => $rows['nilai_mutasi'],
                    'nilai_perolehan' => $rows['nilai_perolehan'],
                    'nilai_penyusutan' => $rows['nilai_penyusutan'],
                    'nilai_buku' => $rows['nilai_buku'],
                    'kuantitas' => $rows['kuantitas'],
                    'jumlah_foto' => $rows['jml_foto'],
                    'status_penggunaan' => $rows['status_penggunaan'],
                    'no_psp' => $rows['no_psp'],
                    'tanggal_psp' => date('Y-m-d', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rows['tgl_psp'])),
                    'no_tiket_usul_psp' => $rows['no_tiket_usul_psp'] ?? null,
                    'intra_ekstra' => $rows['intraekstra'] ?? null,
                    'status_bpybds' => $rows['status_bpybds'] ?? null,
                    'status_henti_guna' => $rows['status_henti_guna'] ?? null,
                    'status_kemitraan' => $rows['status_kemitraan'] ?? null,
                    'status_barang_hilang' => $rows['status_barang_hilang'] ?? null,
                    'status_barang_dktp' => $rows['status_barang_dktp'] ?? null,
                    'status_usul_rusak_berat' => $rows['status_usul_rusak_berat'] ?? null,
                    'status_usul_hapus' => $rows['status_usul_hapus'] ?? null,
                    'sisa_umur' => $rows['sisa_umur_semester'] ?? null,
                    'status_sakti' => $rows['status_sakti'] ?? null,
                ]);
            }
        }
    }
}
