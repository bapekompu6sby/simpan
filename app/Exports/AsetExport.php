<?php

namespace App\Exports;

use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AsetExport implements FromQuery, WithHeadings, WithMapping, WithStrictNullComparison, WithStyles, ShouldAutoSize
{
    protected $excludedColumns = ['id_barang', 'id_kategori', 'created_at', 'updated_at'];
    protected $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function query()
    {
        $table = (new Barang())->getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $columns = array_diff($columns, $this->excludedColumns);
        $columns = array_merge($columns, ['lokasi']);

        $query = Barang::with('kategori')->withLatestLokasi()->select($columns);

        if ($this->id) {
            $query->where('id_kategori', $this->id);
        }

        return $query;
    }

    public function headings(): array
    {
        $table = (new Barang())->getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $customColumns = ['lokasi_sekarang'];
        $columns = array_diff($columns, $this->excludedColumns);
        $columns = array_merge($columns, $customColumns);

        $customHeadings = [
            'no' => 'NO',
            'kode_satker' => 'Kode Satker',
            'nama_satker' => 'Nama Satker',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'nup' => 'NUP',
            'kondisi' => 'Kondisi',
            'merek' => 'Merek',
            'tipe' => 'Tipe',
            'no_bpkb' => 'NO BPKB',
            'no_polisi' => 'NO Polisi',
            'tanggal_perolehan' => 'Tgl Perolehan',
            'tanggal_awal_pakai' => 'Tgl Awal Pakai',
            'nilai_perolehan_pertama' => 'Nilai Perolehan Pertama',
            'nilai_mutasi' => 'Nilai Mutasi',
            'nilai_perolehan' => 'Nilai Perolehan',
            'nilai_penyusutan' => 'Nilai Penyusutan',
            'nilai_buku' => 'Nilai Buku',
            'kuantitas' => 'Kuantitas',
            'jumlah_foto' => 'Jml Foto',
            'status_penggunaan' => 'Status Penggunaan',
            'no_psp' => 'No PSP',
            'tanggal_psp' => 'Tgl PSP',
            'no_tiket_usul_psp' => 'No Tiket Usul PSP',
            'intra_ekstra' => 'Intra/Ekstra',
            'status_bpybds' => 'Status BPYBDS',
            'status_henti_guna' => 'Status Henti Guna',
            'status_kemitraan' => 'Status Kemitraan',
            'status_barang_hilang' => 'Status Barang Hilang',
            'status_barang_dktp' => 'Status Barang DKTP',
            'status_usul_rusak_berat' => 'Status Usul Rusak Berat',
            'status_usul_hapus' => 'Status Usul Hapus',
            'sisa_umur' => 'Sisa Umur',
            'status_sakti' => 'Status Sakti',
            'kode_register_sakti' => 'Kode Register Sakti',
            'lokasi_sekarang' => 'Lokasi Sekarang',
        ];

        $headings = ['NO'];
        foreach ($columns as $column) {
            $headings[] = $customHeadings[$column] ?? $column;
        }

        return $headings;
    }

    public function map($row): array
    {
        static $no = 1;
        $table = (new Barang())->getTable();
        $columns = DB::getSchemaBuilder()->getColumnListing($table);
        $columns = array_diff($columns, $this->excludedColumns);

        $mappedData = [];
        $mappedData[] = $no++;
        
        foreach ($columns as $column) {
            $value = $row->{$column};

            if (is_null($value) && $value !== 0) {
                $value = $this->getDefaultValue($column);
            }

            $mappedData[] = $value;
        }

        $mappedData[] = $row->lokasi ? $row->lokasi : 'Tidak Diketahui';

        return $mappedData;
    }

    private function getDefaultValue($column)
    {
        $defaultValues = [
            'no_tiket_usul_psp' => '-',
        ];

        return $defaultValues[$column] ?? '-';
    }

    public function styles(Worksheet $sheet)
    {
        // Menetapkan gaya teks tebal dan alignment center untuk baris pertama
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Menetapkan alignment left untuk setiap sel selain header
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $range = 'A2:' . $lastColumn . $lastRow;
        $sheet
            ->getStyle($range)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);

        // Menetapkan border untuk seluruh lembar kerja
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);
    }
}
