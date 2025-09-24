@extends('admin.layout.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
@endsection

@section('content')
    <main id="main-container">
        <!-- Hero -->
        <div class="content">
            <div
                class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-1">
                        {{ $title }}
                    </h1>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                    <a class="btn btn-sm btn-success space-x-1" href="/administrator/aset/import">
                        <i class="fa fa-upload opacity-50"></i>
                        <span>Import Barang</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Responsive -->
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <div class="d-flex justify-content-between">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                id="dropdown-default-primary" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Pilih Kategori
                            </button>
                            <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-primary">
                                <a class="dropdown-item" href="/administrator/aset">ALL</a>
                                @foreach ($kategori as $ktg)
                                    <a class="dropdown-item"
                                        href="/administrator/aset/kategori/{{ $ktg->slug }}">{{ $ktg->nama_kategori }}</a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('admin.aset.export.by.kategori', ['slug' => $kategoriNow]) }}" class="btn btn-sm btn-primary">Export
                            Excel</a>
                    </div>
                    <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive">
                        <thead>
                            <tr>
                                <th class="no-print">Kategori</th>
                                <th class="">Kode Barang</th>
                                <th class="">Nama Barang</th>
                                <th class="">NUP</th>
                                <th class="">Merek</th>
                                <th>Lokasi Sekarang</th>
                                <th style="width:10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Dynamic Table Responsive -->
        </div>
        <!-- END Page Content -->
    </main>

    {{-- Modal Set Lokasi --}}
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Data Lokasi</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('admin.lokasi.set') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="block-content fs-sm">
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Lokasi</label>
                                            <input class="form-control" type="text" name="lokasi" id="lokasi"
                                                placeholder="Lokasi Baru">
                                            <input class="form-control" type="hidden" name="id_barang" id="id_barang"
                                                placeholder="Id Barang">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <!-- jQuery (required for DataTables plugin) -->

    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    {{-- //Tambahan --}}
    <script src="{{ asset('assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.js-dataTable-responsive').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('admin.data.aset.kategori', Request::segment(4)) }}",
                    "type": "GET",
                },
                "columns": [{
                        "data": "kategori",
                        "className": "no-print",
                        "responsivePriority": 6
                    },
                    {
                        "data": "kode_barang",
                        "responsivePriority": 1
                    },
                    {
                        "data": "nama_barang",
                        "responsivePriority": 7
                    },
                    {
                        "data": "nup",
                        "responsivePriority": 2
                    },
                    {
                        "data": "merek",
                        "responsivePriority": 5
                    },
                    {
                        "data": "lokasi",
                        "responsivePriority": 4
                    },
                    {
                        "data": "aksi",
                        "responsivePriority": 3
                    }
                ],
                "responsive": true,
                "pageLength": 15,
                "pagingType": "full_numbers",
                "lengthMenu": [15, 30, 50, 75, 100],
                "order": [
                    [1, 'asc']
                ],
                "dom": "<'row'<'col-sm-12'<'py-2 mb-2 text-end'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "language": {
                    "paginate": {
                        "previous": "Prev",
                        "next": "Next",
                        "first": "<i class='fa fa-angle-double-left'></i>",
                        "previous": "<i class='fa fa-angle-left'></i>",
                        "next": "<i class='fa fa-angle-right'></i>",
                        "last": "<i class='fa fa-angle-double-right'></i>"
                    }
                }
            });

            // Gunakan event delegation untuk menangani klik pada tombol edit
            $(document).on('click', '.editButton', function() {
                var id = $(this).data('id');
                var lokasi = $(this).data('lokasi');

                var modal = document.getElementById("editModal");
                var namaLokasiInput = modal.querySelector("#lokasi");
                var idBarangInput = modal.querySelector("#id_barang");

                namaLokasiInput.value = lokasi;
                idBarangInput.value = id;
                var editModal = new bootstrap.Modal(modal);
                editModal.show();
            });
        });
    </script>
@endsection
