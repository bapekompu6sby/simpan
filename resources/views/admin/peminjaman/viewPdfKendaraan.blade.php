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

        @media print {
            body {
                margin: -0cm 1cm 0.5cm 1cm;
            }

            .container {
                page-break-inside: avoid;
                margin-top: -100px;
            }

            table {
                page-break-inside: avoid;
            }

            .ttd-container {
                margin-top: 20px;
            }
        }

        td {
            word-wrap: break-word;
        }

        p, li {
            text-align: justify;
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
                    style="margin-bottom: 20px; margin-top: 3px; text-align:center; font-weight:bold;">
                    PERMOHONAN</p>
                <p style="margin-top: -20px; text-align:center;">ANGKUTAN KENDARAAN BERMOTOR KENDARAAN DINAS <br> (F-01/DM/P/TU/10//BD04. Ref : 00) <br> (DIISI PEMOHON)</p>
                <table style="margin-top: 20px">
                    <tr>
                        <td>Nama</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->peminjam }}</td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ $peminjaman[0]->jabatan }}</td>
                    </tr>
                    <tr>
                        <td>Keperluan</td>
                        <td style="padding-left:50px;">:</td>
                        <td style="word-wrap: break-word;vertical-align:top">{{ $peminjaman[0]->deskripsi }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal yang diperlukan</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }} - {{ Carbon::parse($peminjaman[0]->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lama Pemakaian</td>
                        <td style="padding-left:50px;">:</td>
                        <td>{{ max(1, Carbon::parse($peminjaman[0]->tanggal_pinjam)->diffInDays(Carbon::parse($peminjaman[0]->tanggal_kembali))) }} hari</td>
                    </tr>
                </table>
            </div>
        <div class="ttd-container" style="margin-top:25px;">
           <table style="border-collapse: collapse; width: 100%; table-layout: fixed;">
            <thead style="text-align: center;">
                <tr>
                    <td style="width: 40%;">Mengetahui, <br>{{ $peminjaman[0]->jabatan_penandatangan }}</td>
                    <td style="width: 20%;"></td>
                    <td style="width: 40%;">Pemohon</td>
                </tr>
            </thead>
            <tbody style="text-align: center; text-indent: 5px;">
                <tr>
                    <td style="height:130px; vertical-align:bottom; width: 40%;">
                        <span style="font-weight:bold"><u>{{ $peminjaman[0]->nama_penandatangan }}</u></span> <br> 
                        NIP. {{ $peminjaman[0]->nip_penandatangan }}
                    </td>
                    <td style="height:50px; width: 20%;"></td>
                    <td style="height:50px; vertical-align:bottom; width: 40%;">
                        <span style="font-weight:bold"><u>{{ $peminjaman[0]->peminjam }}</u></span><br>
                        NIP. {!! $peminjaman[0]->nip ?? '<span style="color:white;">198308242010121005</span>' !!}
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
            <div class="isi-surat" style="margin-top: 10px">
                <h3 style="font-weight: bold">PERINTAH JALAN</h3>
                <hr style="border:0; height:2px; background-color:black; margin:0; margin-top:-15px">
                <p style="margin-top: 0px">ANGKUTAN BERMOTOR KENDARAAN DINAS <br>  <br> </p>
                <hr style="border:0; height:2px; background-color:black; margin:0; margin-top:-15px">

                <table style="border-collapse: collapse; width: 100%; border: 1px solid black; text-align: center; margin-top:10px">
                    <thead style="border: 1px solid black;">
                        <tr>
                            <th style="border: 1px solid black;">No</th>
                            <th style="border: 1px solid black;">Jenis Kendaraan</th>
                            <th style="border: 1px solid black;">No. Polisi</th>
                            <th style="border: 1px solid black;">Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjaman[0]->detailPeminjaman as $detail)
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                                <td style="border: 1px solid black;">
                                    {{ $detail->barang->merek }}</td>
                                <td style="border: 1px solid black;">
                                    {{ $detail->barang->no_polisi }} </td>
                                    <td style="border: 1px solid black;">
                                        {{ $detail->lokasi_akhir }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="ttd-container" style="margin-top:30px;">
            <table style="border-collapse: collapse; width: 100%;">
                <thead style="text-align: center;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Surabaya,
                            {{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}<br><br>Petugas Pemeliharaan</td>
                    </tr>
                </thead>
                <tbody style="text-align: center; text-indent: 5px;">
                    <tr>
                        <td style="height:135px; vertical-align:bottom"></td>
                        <td style="height:50px; width: 400px;"></td>
                        <td style="height:50px; vertical-align:bottom"><span style="font-weight:bold"><u>{{$petugas[0]->nama}}</u></span> <br>NIP. {{$petugas[0]->nip}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="position: relative; bottom: 0; width: 100%; font-size: 11px; text-align: left; padding: 5px 5px; box-sizing: border-box;">
            <p style="line-height: 1;">
             <strong>*</strong> Untuk kebutuhan Bahan Bakar Minyak (BBM), biaya ditanggung secara mandiri.
            </p>
            <p style="line-height: 1;">
             <strong>**</strong> Peminjam bertanggung jawab untuk menjaga kondisi Barang Milik Negara (BMN) selama masa peminjaman.
            </p>
    </div>
</body>

</html>
