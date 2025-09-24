@extends('admin.layout.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css') }}">
@endsection

@section('content')
    <main id="main-container">
        <div class="content">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">
                    <h1 class="h3 fw-bold mb-1 no-print">
                        {{ $title }}
                    </h1>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                    <button type="button" class="btn btn-sm btn-secondary push" data-bs-toggle="modal" data-bs-target="#modal-block-popin">
                        <i class="fa fa-plus opacity-50"></i> Tambah Penandatangan
                    </button>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive-penandatangan">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th style="width: 100px;" class="no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penandatangan as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->jabatan }}</td>
                                    <td class="fw-semibold fs-sm">
                                        <button type="button" class="btn btn-sm btn-warning editButton" data-id="{{ $data->id_penandatangan }}" data-nama="{{ $data->nama }}" data-nip="{{ $data->nip }}" data-jabatan="{{ $data->jabatan }}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <a href="{{ route('admin.penandatangan.delete', ['id' => $data->id_penandatangan]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Data Penandatangan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="block-content fs-sm">
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Nama</label>
                                            <input class="form-control" type="text" name="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">NIP</label>
                                            <input class="form-control" type="number" name="nip" placeholder="NIP" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Jabatan</label>
                                            <input class="form-control" type="text" name="jabatan" placeholder="Jabatan" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Data Penandatangan</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('admin.penandatangan.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="block-content fs-sm">
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label">Nama</label>
                                            <input class="form-control" type="text" name="nama" id="edit_nama" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">NIP</label>
                                            <input class="form-control" type="number" name="nip" id="edit_nip" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Jabatan</label>
                                            <input class="form-control" type="text" name="jabatan" id="edit_jabatan" required>
                                            <input class="form-control" type="hidden" name="id_penandatangan" id="edit_id">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
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
    <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
    <script>
        var editButtons = document.querySelectorAll('.editButton');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                var nip = button.getAttribute('data-nip');
                var jabatan = button.getAttribute('data-jabatan');
                var modal = document.getElementById('editModal');
                modal.querySelector('#edit_nama').value = nama;
                modal.querySelector('#edit_nip').value = nip;
                modal.querySelector('#edit_jabatan').value = jabatan;
                modal.querySelector('#edit_id').value = id;
                var editModal = new bootstrap.Modal(modal);
                editModal.show();
            });
        });
    </script>
@endsection
