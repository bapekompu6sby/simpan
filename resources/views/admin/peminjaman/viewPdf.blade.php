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
        font-size: 11pt;
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
                <p
                    style="margin-bottom: 20px; margin-top: 3px; text-align:center; font-weight:bold; text-decoration:underline">
                    SURAT PEMINJAMAN BMN</p>
            <table style="width: 100%; font-family: Arial, sans-serif; margin-top: 10px;">
            <tr>
                <td style="padding-bottom: 10px;">Kami yang bertanda tangan di bawah ini:</td>
            </tr>
            </table>
            <table style="width: 100%; font-family: Arial, sans-serif; line-height: 1.5; table-layout: fixed;">
            <tr>
                <td style="width: 30%; vertical-align: top; white-space: nowrap;">Nama Peminjam</td>
                <td style="width: 3%; vertical-align: top; text-align: center;">:</td>
                <td style="width: 67%; vertical-align: top; word-break: break-word;">{{ $peminjaman[0]->peminjam }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; white-space: nowrap;">Instansi Peminjam</td>
                <td style="text-align: center;">:</td>
                <td style="word-break: break-word;">{{ $peminjaman[0]->instansi }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; white-space: nowrap;">Alamat</td>
                <td style="text-align: center; vertical-align: top;">:</td>
                <td style="text-align: justify; word-break: break-word;">{{ $peminjaman[0]->alamat }}</td>
            </tr>
            <tr>
                <td style="vertical-align: top; white-space: nowrap;">Nomor Telp / HP</td>
                <td style="text-align: center;">:</td>
                <td style="word-break: break-word;">{{ $peminjaman[0]->no_telp }}</td>
            </tr>
            </table>
            </div>
            <div class="isi-surat">
                <p>Telah meminjam barang milik negara, dari Balai Pengembangan Kompetensi Wilayah VI Surabaya peralatan
                    dibawah ini:</p>

                <table style="border-collapse: collapse; width: 100%; border: 1px solid black; text-align: center;">
                    <thead style="border: 1px solid black;">
                        <tr>
                            <th style="border: 1px solid black;">No</th>
                            <th style="border: 1px solid black;">Nama Barang</th>
                            <th style="border: 1px solid black;">Merk / Type</th>
                            <th style="border: 1px solid black;">Jumlah</th>
                            <th style="border: 1px solid black;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman[0]->detailPeminjaman as $detail)
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                                <td style="border: 1px solid black;">
                                    {{ $detail->barang->nama_barang . ' (' . $detail->barang->nup . ')' }}</td>
                                <td style="border: 1px solid black;">
                                    {{ $detail->barang->merek . ' / ' . $detail->barang->tipe }} </td>
                                <td style="border: 1px solid black;">1</td>
                                <td style="border: 1px solid black;">{{ $detail->deskripsi == null ? '-' :  $detail->deskripsi}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p>Untuk keperluan :
                    {{ $peminjaman[0]->deskripsi == null ? 'kegiatan melaksanakan tugas panitia' : $peminjaman[0]->deskripsi }}
                </p>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid black;">
                    <thead style="border: 1px solid black; text-align: center;">
                        <tr>
                            <th style="border: 1px solid black;">Tanggal Pinjam : <br> <span
                                    style="font-weight: normal;">{{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}</span>
                            </th>
                            <th style="border: 1px solid black;">Tanggal Kembali : <br> <span
                                    style="font-weight: normal;">
                                    @if ($peminjaman[0]->status == '0')
                                        {{ Carbon::parse($peminjaman[0]->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}
                                    @else
                                        {{ Carbon::parse($peminjaman[0]->updated_at)->locale('id')->translatedFormat('d F Y') }}
                                    @endif

                                </span></th>
                            <th style="border: 1px solid black;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: left; text-indent: 5px;">
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black; height:50px;">T. tangan : </td>
                            <td style="border: 1px solid black; height:50px;">T. tangan : </td>
                            <td rowspan="2" style="border: 1px solid black; text-align:center"></td>
                        </tr>
                        <tr style="border: 1px solid black;">
                            <td style="border: 1px solid black; height:50px;">Kondisi alat : Baik</td>
                            <td style="border: 1px solid black; height:50px;">Kondisi alat : Baik</td>
                        </tr>
                    </tbody>
                </table>

                <p style="line-height: 1.5;">
                    Menyatakan bahwa saya sebagai peminjam / pengguna peralatan milik Balai Pengembangan Kompetensi
                    Wilayah VI Surabaya akan memakai peralatan tersebut dengan hati-hati, sesuai dengan prosedur dan
                    spesifikasi peralatan tersebut.</p>
            </div>
        </div>
        <div class="ttd-container" style="margin-top:10px;">
        <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
            <thead style="text-align: center;">
                <tr>
                    <td style="width: 40%;">
                        <br><br>{{ $peminjaman[0]->jabatan_penandatangan }}
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;">
                        Surabaya,
                        {{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}
                        <br><br>Pengguna BMN
                    </td>
                </tr>
            </thead>
            <tbody style="text-align: center; text-indent: 5px;">
                <tr>
                    <td style="height:150px; vertical-align:bottom; width: 33%;">
                         <span style="font-weight:bold"><u>{{ $peminjaman[0]->nama_penandatangan }}</u></span> <br>
                        NIP. {{ $peminjaman[0]->nip_penandatangan }}
                    </td>
                    <td style="height:50px; width: 20%;"></td>
                    <td style="height:50px; vertical-align:bottom; width: 40%;">
                        <span style="font-weight:bold"><u>
                        {{ $peminjaman[0]->peminjam }}</u></span><br>
                        NIP. {!! $peminjaman[0]->nip ?? '<span style="color:white;">198308242010121005</span>' !!}
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div style="position: relative; bottom: 0; width: 100%; font-size: 11px; text-align: left; padding: 7px 5px; box-sizing: border-box;">
            <p style="line-height: 1.5;">
             <strong>**</strong> Peminjam bertanggung jawab untuk menjaga kondisi Barang Milik Negara (BMN) selama masa peminjaman.
            </p>
        </div>
</body>

</html>
