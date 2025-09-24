@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <title>{{ $peminjaman[0]->peminjam }}
        ({{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }})</title>
</head>

<style>
    * {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    td {
        word-wrap: break-word;
    }

    p,
    li {
        text-align: justify
    }
</style>


<body>

    <div class="container">
       <div class="kopsurat" style="border-bottom: 2px solid black; width: 100%;">
        <table style="width: 100%; border-collapse: collapse; vertical-align: top;">
            <tr>
            <td style="width: 100px; padding-left: 30px;">
                <img src="{{ $logo }}" alt="Logo PUPR" width="70" height="70">
            </td>
            <td style="padding-right: 30px;">
                <div style="line-height: 1.2; text-align: justify; text-justify: inter-word;">
                <div style="font-size: 25px; font-weight: bold; letter-spacing: 3px;  word-spacing: 16px;">
                    KEMENTERIAN PEKERJAAN UMUM
                </div>
                <div style="font-size: 18px; letter-spacing: 2px; word-spacing: 5px; margin-top: -5px;">
                    BADAN PENGEMBANGAN SUMBER DAYA MANUSIA
                </div>
                <div style="font-size: 12px; font-weight: bold; letter-spacing: 1px; word-spacing: 5px;">
                    SATKER BALAI PENGEMBANGAN KOMPETENSI PU WILAYAH VI SURABAYA
                </div>
                <div style="font-size: 10px; letter-spacing: 0.27px; word-spacing: 0.27px;">
                    Jalan Gayung Kebonsari No.48, Gayungan, Surabaya 60234, Telepon (031) 8291040, 8286501 Faksimili 8275847
                </div>
                </div>
            </td>
            </tr>
        </table>
        </div>
        <br>
        <div class="isi">
            <div class="judul">
                <p style="margin-top: 3px; text-align:center; font-weight:bold;">
                    SURAT IZIN PEMAKAIAN LAPTOP UNTUK OPERASIONAL <br> KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT
                    <br> NOMOR : 02/KET/Mo/2024</p>
                <table>
                    <tr>
                        <td>Dalam rangka penggunaan pemakaian Laptop/Notebook pada Satuan Kerja Balai Pengembangan Kompetensi Wilayah VI Surabaya, dengan ini:</td>
                    </tr>
                </table>
                <table style="margin-top: 10px">
                    <tr>
                        <td>Nama</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->peminjam }}</td>
                    </tr>
                    <tr>
                        <td>NIP</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->nip }}</td>
                    </tr>
                    <tr>
                        <td>Pangkat/Golongan</td>
                        <td style="padding-left:50px;">:</td>
                        <td style="word-wrap: break-word;vertical-align:top">{{ $peminjaman[0]->instansi }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Rumah</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->alamat }}</td>
                    </tr>
                </table>
                <p style="margin-top: 10px; text-align:center; font-weight:bold;">DIIZINKAN</p>
                <table>
                    <tr>
                        <td>Untuk memakai dan menyimpan di rumah 1 (satu) unit Laptop / Notebook yaitu:</td>
                    </tr>
                </table>
                <table style="margin-top: 5px">
                    <tr>
                        <td>Laptop/Notebook</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->detailPeminjaman[0]->barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <td>Merk / Type</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->detailPeminjaman[0]->barang->merek }}</td>
                    </tr>
                    <tr>
                        <td>Warna</td>
                        <td style="padding-left:50px;">:</td>
                        <td style="word-wrap: break-word;vertical-align:top">{{ $peminjaman[0]->detailPeminjaman[0]->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td>Kode Barang/NUP</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->detailPeminjaman[0]->barang->kode_barang . '/' . $peminjaman[0]->detailPeminjaman[0]->barang->nup }}</td>
                    </tr>
                    <tr>
                        <td>Tahun</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ Carbon::parse($peminjaman[0]->detailPeminjaman[0]->barang->tanggal_awal_pakai)->locale('id')->translatedFormat('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pinjam</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kembali </td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ Carbon::parse($peminjaman[0]->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
                <table style="margin-top: 10px;">
                    <tr>
                        <td>Dengan Ketentuan:</td>
                    </tr>
                </table>
                <div style="margin-top: -15px;">
                    <ol>
                        <li>Izin bersifat sementara dan akan disesuaikan dengan kebutuhan dinas dan penugasan pejabat yang bersangkutan;</li>
                        <li>Pemakai bertanggung jawab atas segala perawatan, pemeliharaan, kerusakan dan kehilangan, dan bersedia dikenakan Tuntutan Ganti Rugi sesuai dengan ketentuan peraturan perundang-undangan;</li>
                        <li>Laptop/Notebook hanya untuk keperluan dinas/tugas, dan tidak dibenarkan untuk keperluan pribadi/keluarga;</li>
                        <li>Pemakai menandatangani Surat Pernyataan Kesediaan mengembalikan Laptop/Notebook  kepada Satuan Kerja selaku Kuasa Pengguna Barang, sebagaimana terlampir;</li>
                        
                    </ol>
                </div>
            </div>

            <div class="ttd-container" style="margin-top:15px;">
                <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
                    <thead style="text-align: center;">
                        <tr>
                            <td style="width: 40%;">
                                <br><br>Pemakai <br> Laptop/Notebook
                            </td>
                            <td style="width: 20%;"></td>
                            <td style="width: 40%;">
                                Surabaya, {{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}
                                <br><br><br>{{ $peminjaman[0]->jabatan_penandatangan }}
                            </td>
                        </tr>
                    </thead>
                    <tbody style="text-align: center; text-indent: 5px;">
                        <tr>
                            <td style="height:130px; vertical-align:bottom; width: 49%;">
                                <span style="font-weight:bold"><u>{{ $peminjaman[0]->peminjam }}</u></span><br>
                                NIP. {{ $peminjaman[0]->nip }}
                            </td>
                            <td style="height:50px; width: 20%;"></td>
                            <td style="height:130px; vertical-align:bottom; width: 40%;">
                                <span style="font-weight:bold"><u>{{ $peminjaman[0]->nama_penandatangan }}</u></span><br>
                                NIP. {{ $peminjaman[0]->nip_penandatangan }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div style="position: relative; bottom: 0; width: 100%; font-size: 11px; text-align: left; padding: 7px 5px; box-sizing: border-box;">
                <p style="line-height: 1.5;">
                <strong>**</strong> Peminjam bertanggung jawab untuk menjaga kondisi Barang Milik Negara (BMN) selama masa peminjaman.
                </p>
    </div>
</body>

</html>
