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
        <!-- Hero -->
        <div class="content">
            <div
                class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-1">
                        {{ $title . ' Aset ' . $peminjaman[0]->tipe }} -
                        {{ $peminjaman[0]->peminjam .' (' .Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') .')' }}
                    </h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Quick Overview -->
            <div class="row d-flex">
                <div class="col-6">
                    <!-- Billing Address -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Detail Peminjam</h3>
                        </div>
                        <div class="block-content">
                            <div class="fs-4 mb-1">{{ $peminjaman[0]->peminjam }}</div>
                            @if ($peminjaman[0]->tipe === 'Kendaraan' || $peminjaman[0]->tipe === 'Laptop')
                                <b>Jabatan </b> : {{ $peminjaman[0]->jabatan }}
                            @endif
                            <address class="fs-sm py-1">
                                @if ($peminjaman[0]->tipe === 'Laptop')
                                    <b>Pangkat / Golongan</b> : {{ $peminjaman[0]->instansi }}
                                    <br>
                                @endif
                                <b>Tanggal Pinjam</b> :
                                {{ Carbon::parse($peminjaman[0]->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}<br>
                                @if ($peminjaman[0]->status === '0')
                                    <b>Tanggal Kembali</b> :
                                    {{ Carbon::parse($peminjaman[0]->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}<br>
                                @else
                                    <b>Rencana Tanggal Kembali</b> :
                                    {{ Carbon::parse($peminjaman[0]->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}<br>
                                    <b>Tanggal Kembali</b> :
                                    {{ Carbon::parse($peminjaman[0]->updated_at)->locale('id')->translatedFormat('d F Y') }}<br>
                                @endif
                                @if ($peminjaman[0]->tipe != 'Laptop')
                                    <b>Keperluan </b> : {{ $peminjaman[0]->deskripsi }}
                                    <br>
                                @endif
                                @if ($peminjaman[0]->tipe === 'Kendaraan')
                                @else
                                    <b>Alamat</b> : {{ $peminjaman[0]->alamat }}<br>
                                    @if ($peminjaman[0]->tipe != 'Laptop')
                                        <i class="fa fa-phone"></i> {{ $peminjaman[0]->no_telp }}<br>
                                    @endif
                                @endif

                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <!-- Billing Address -->
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Status Peminjaman</h3>
                        </div>
                        @if ($peminjaman[0]->status === '0')
                            <div class="block block-rounded block-link-shadow text-center">
                                <div class="block-content block-content-full">
                                    <div class="item item-circle bg-warning-light mx-auto">
                                        <i class="fa fa-sync fa-spin text-warning fa-xl"></i>
                                    </div>
                                </div>
                                <div class="block-content py-2 bg-body-light">
                                    <p class="fw-medium fs-md text-warning mb-0">
                                        Sedang Berlangsung
                                    </p>
                                </div>
                            </div>
                        @elseif ($peminjaman[0]->status === '1')
                            <div class="block block-rounded block-link-shadow text-center">
                                <div class="block-content block-content-full">
                                    <div class="item item-circle bg-success-light mx-auto">
                                        <i class="fa fa-check text-success fa-xl"></i>
                                    </div>
                                </div>
                                <div class="block-content py-2 bg-body-light ">
                                    <p class="fw-medium fs-md text-success mb-0">
                                        Selesai
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- END Quick Overview -->

            <!-- Products -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">List Barang</h3>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        {{ $peminjaman[0]->tipe === 'Kendaraan' ? 'Jenis Kendaraan' : 'Nama Barang' }}</th>
                                    <th class="text-center">Kode Barang</th>
                                    <th class="text-center">NUP</th>
                                    <th class="text-center">Lokasi Awal</th>
                                    <th class="text-center">Lokasi Tujuan</th>
                                    <th class="text-center">
                                        {{ $peminjaman[0]->tipe === 'Kendaraan' ? 'No Polisi' : ($peminjaman[0]->tipe === 'Laptop' ? 'Warna' : 'Deskripsi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjaman[0]->detailPeminjaman as $detail)
                                    <tr>
                                        <td class="text-center">{{ $peminjaman[0]->tipe === 'Kendaraan' ? $detail->barang->merek : $detail->barang->nama_barang }}</td>
                                        <td class="text-center">{{ $detail->barang->kode_barang }}</td>
                                        <td class="text-center">{{ $detail->barang->nup }}</td>
                                        <td class="text-center">{{ $detail->lokasi_awal }}</td>
                                        <td class="text-center">{{ $detail->lokasi_akhir }}</td>
                                        <td class="text-center">
                                            {{ $peminjaman[0]->tipe === 'Kendaraan' ? $detail->barang->no_polisi : ($detail->deskripsi ? $detail->deskripsi : '-') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="text-end mb-5">
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-danger"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
                <a target="_blank" href="{{ route('admin.peminjaman.print', ['id' => $peminjaman[0]->id_peminjaman]) }}"
                    class="btn btn-sm btn-success"><i class="fas fa-print"></i> Cetak</a>
            </div>
            <!-- END Products -->
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
