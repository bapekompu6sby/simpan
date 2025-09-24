<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PeminjamanExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function query()
    {
        return Peminjaman::query()
            ->with(['detailPeminjaman.barang'])
            ->select('peminjaman.*');
    }

    public function headings(): array
    {
        return [
            'Nama Barang', 'NUP', 'Peminjam', 'Deskripsi Peminjaman', 'Tanggal Pinjam', 'Tanggal Kembali', 'Lokasi Awal', 'Lokasi Akhir', 'Deskripsi Peminjaman Barang', 'Status'
        ];
    }

    public function map($peminjaman): array
    {
        $mappedData = [];

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $status = $peminjaman->status == 1 ? 'Selesai' : 'Belum Dikembalikan';
            $mappedData[] = [
                $detail->barang->nama_barang,
                $detail->barang->nup,
                $peminjaman->peminjam,
                $peminjaman->deskripsi,
                $peminjaman->tanggal_pinjam,
                $peminjaman->tanggal_kembali,
                $detail->lokasi_awal,
                $detail->lokasi_akhir,
                $detail->deskripsi,
                $status,
            ];
        }

        return $mappedData;
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
        $sheet->getStyle($range)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

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


