@extends('admin.layout.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
@endsection

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    <main id="main-container">
        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="col-xl-12 order-xl-12">
                    <!-- Product -->
                    <div class="block block-rounded">
                        <div class="block-content">
                            <a href="/administrator/aset" class="btn btn-sm btn-danger text-start">Kembali</a>
                            <!-- Extra Info Tabs -->
                            <div class="block block-rounded">
                                <h2 class="mt-4">{{ $barang->nama_barang }}</h2>
                                <ul class="nav nav-tabs nav-tabs-alt align-items-center" role="tablist">
                                    <li class="nav-item">
                                        <button type="button" class="nav-link active" id="ecom-product-info-tab"
                                            data-bs-toggle="tab" data-bs-target="#ecom-product-info" role="tab"
                                            aria-controls="ecom-product-reviews" aria-selected="true">Detail Info</button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="nav-link" id="ecom-product-comments-tab"
                                            data-bs-toggle="tab" data-bs-target="#ecom-product-comments" role="tab"
                                            aria-controls="ecom-product-reviews" aria-selected="false">Riwayat
                                            Lokasi</button>
                                    </li>
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane pull-x active" id="ecom-product-info" role="tabpanel"
                                        aria-labelledby="ecom-product-info-tab" tabindex="0">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-borderless">
                                                <tbody class="text-wrap">
                                                    <tr>
                                                        <td><b>Kategori</b></td>
                                                        <td>
                                                            {{ $barang->kategori->nama_kategori }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Kode Satker</b></td>
                                                        <td>
                                                            {{ $barang->kode_satker }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nama Satker</b></td>
                                                        <td>
                                                            {{ $barang->nama_satker }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Kode Barang</b></td>
                                                        <td>
                                                            {{ $barang->kode_barang }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>NUP</b></td>
                                                        <td>
                                                            {{ $barang->nup }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Kondisi</b></td>
                                                        <td>
                                                            {{ $barang->kondisi }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Merek</b></td>
                                                        <td>
                                                            {{ $barang->merek }}
                                                        </td>
                                                    </tr>
                                                    @if ($barang->no_polisi == null)
                                                        <tr>
                                                            <td><b>Tipe</b></td>
                                                            <td>
                                                                {{ $barang->tipe }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td><b>Tanggal Perolehan</b></td>
                                                        <td>
                                                            {{ Carbon::parse($barang->tanggal_perolehan)->locale('id')->translatedFormat('d F Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>{{ $barang->no_polisi == null ? 'Tanggal Awal Pakai' : 'Tanggal Rekam Pertama' }}</b>
                                                        </td>
                                                        <td>
                                                            {{ Carbon::parse($barang->tanggal_awal_pakai)->locale('id')->translatedFormat('d F Y') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nilai Perolehan Pertama</b></td>
                                                        <td>
                                                            {{ 'Rp ' . number_format($barang->nilai_perolehan_pertama, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nilai Mutasi</b></td>
                                                        <td>
                                                            {{ $barang->nilai_mutasi }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nilai Perolehan</b></td>
                                                        <td>
                                                            {{ 'Rp ' . number_format($barang->nilai_perolehan, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nilai Penyusutan</b></td>
                                                        <td>
                                                            {{ 'Rp ' . number_format($barang->nilai_penyusutan, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nilai Buku</b></td>
                                                        <td>
                                                            {{ $barang->nilai_buku }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Kuantitas</b></td>
                                                        <td>
                                                            {{ $barang->kuantitas }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Jumlah Foto</b></td>
                                                        <td>
                                                            {{ $barang->jumlah_foto }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Status Penggunaan</b></td>
                                                        <td>
                                                            {{ $barang->status_penggunaan }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No PSP</b></td>
                                                        <td>
                                                            {{ $barang->no_psp }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Tanggal PSP</b></td>
                                                        <td>
                                                            {{ Carbon::parse($barang->tanggal_psp)->locale('id')->translatedFormat('d F Y') }}
                                                        </td>
                                                    </tr>
                                                    @if ($barang->no_polisi == null)
                                                        <tr>
                                                            <td><b>No Tiket Usul PSP</b></td>
                                                            <td>
                                                                {{ $barang->no_tiket_usul_psp != null ? $barang->no_tiket_usul_psp : '-' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Intra/Ekstra</b></td>
                                                            <td>
                                                                {{ $barang->intra_ekstra }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status BPYBDS</b></td>
                                                            <td>
                                                                {{ $barang->status_bpybds }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Henti Guna</b></td>
                                                            <td>
                                                                {{ $barang->status_henti_guna }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Kemitraan</b></td>
                                                            <td>
                                                                {{ $barang->status_kemitraan }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Barang Hilang</b></td>
                                                            <td>
                                                                {{ $barang->status_barang_hilang }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Barang DKTP</b></td>
                                                            <td>
                                                                {{ $barang->status_barang_dktp }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Usul Rusak Berat</b></td>
                                                            <td>
                                                                {{ $barang->status_usul_rusak_berat }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status Usul Hapus</b></td>
                                                            <td>
                                                                {{ $barang->status_usul_hapus }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Sisa Umur (Semester)</b></td>
                                                            <td>
                                                                {{ $barang->sisa_umur }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Status SAKTI</b></td>
                                                            <td>
                                                                {{ $barang->status_sakti }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Kode Register SAKTI</b></td>
                                                            <td>
                                                                {{ $barang->kode_register_sakti }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                    <tr>
                                                        <td><b>NO BPKB</b></td>
                                                        <td>
                                                            {{ $barang->no_bpkb }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>No Polisi</b></td>
                                                        <td>
                                                            {{ $barang->no_polisi }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td><b>Lokasi Sekarang</b></td>
                                                        <td>
                                                            {{ $barang->lokasi != null ? $barang->lokasi : '-' }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END Info -->

                                    <!-- Comments -->
                                    <div class="tab-pane pull-x fs-sm" id="ecom-product-comments" role="tabpanel"
                                        aria-labelledby="ecom-product-comments-tab" tabindex="0">
                                        <div class="d-flex push">
                                            <div class="block-content block-content-full">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-bordered table-striped table-vcenter js-dataTable-simple">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">Tanggal</th>
                                                                <th class="text-center">Deskripsi</th>
                                                                <th class="text-center">Lokasi Tujuan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lokasi as $lks)
                                                                <tr>
                                                                    <td class="text-center">
                                                                        {{ Carbon::parse($lks->created_at)->locale('id')->translatedFormat('d F Y') }}
                                                                    </td>
                                                                    <td class="text-center">
                                                                        @if ($lks->id_peminjaman == null)
                                                                            Barang Dipindah Oleh {{$pemindah[0]->pengguna->nama}}
                                                                        @elseif ($lks->id_peminjaman != null && $lks->status == '0')
                                                                            Barang Dipinjam Oleh
                                                                            {{ $lks->peminjaman->peminjam }}
                                                                        @elseif ($lks->id_peminjaman != null && $lks->status == '1')
                                                                            Barang Dikembalikan Oleh
                                                                            {{ $lks->peminjaman->peminjam }}
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-center">{{ $lks->lokasi }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Comments -->
                                </div>
                            </div>
                            <!-- END Extra Info Tabs -->
                        </div>
                    </div>
                    <!-- END Product -->
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection

@section('javascript')
    <!-- jQuery (required for DataTables plugin) -->

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
@endsection
