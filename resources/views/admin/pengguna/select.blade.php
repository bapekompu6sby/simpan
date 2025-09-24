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
                    <h1 class="h3 fw-bold mb-1 no-print">
                        {{ $title }}
                    </h1>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                    <button type="button" class="btn btn-sm btn-secondary push" data-bs-toggle="modal"
                        data-bs-target="#modal-block-popin"> <i class="fa fa-plus opacity-50"></i> Tambah Pengguna</button>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Dynamic Table Responsive -->
            <div class="block block-rounded">
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive-pengguna">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th style="width: 100px;" class="no-print">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengguna as $data)
                                <tr>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td class="fw-semibold fs-sm">
                                        <button type="button" class="btn btn-sm btn-warning editButton" data-id="{{ $data->id_pengguna }}" data-name="{{ $data->nama }}" data-username="{{ $data->username }}" data-email="{{ $data->email }}" data-nip="{{ $data->nip }}"><i class="fa fa-fw fa-pencil-alt"></i></button>
                                        <a href="{{ route('admin.pengguna.delete', ['id' => $data->id_pengguna]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Menghapus pengguna akan bedampak ke data yang berelasi')"><i class="fa fa-fw fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Dynamic Table Responsive -->
        </div>
        <!-- END Page Content -->
    </main>

    {{-- Pop In Block Modal --}}
    <div class="modal fade" id="modal-block-popin" tabindex="-1" role="dialog" aria-labelledby="modal-block-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Tambah Data Pengguna</h3>
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
                                            <label class="form-label" for="example-file-input">Nama</label>
                                            <input class="form-control" type="text" name="nama"
                                                id="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Username</label>
                                            <input class="form-control" type="text" name="username"
                                                id="username" placeholder="Username" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">NIP</label>
                                            <input class="form-control" type="number" name="nip"
                                                id="nip" placeholder="NIP" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Email</label>
                                            <input class="form-control" type="email" name="email"
                                                id="email" placeholder="Email" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Password</label>
                                            <input class="form-control" type="password" name="password"
                                                id="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END Pop In Block Modal --}}

    {{-- Modal Edit Data --}}
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modal-block-vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-transparent mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Edit Data Pengguna</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="{{ route('admin.pengguna.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="block-content fs-sm">
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Nama</label>
                                            <input class="form-control" type="text" name="nama"
                                                id="nama" placeholder="Nama" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Username</label>
                                            <input class="form-control" type="text" name="username"
                                                id="username" placeholder="Username" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">NIP</label>
                                            <input class="form-control" type="number" name="nip"
                                                id="nip" placeholder="NIP" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Email</label>
                                            <input class="form-control" type="email" name="email"
                                                id="email" placeholder="Email" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="example-file-input">Password </label>
                                            <input class="form-control" type="password" name="password"
                                                id="password" placeholder="Password">
                                                <span class="text-danger">* Kosongkan jika tidak ingin merubah</span>
                                                <input class="form-control" type="hidden" name="id_pengguna"
                                                id="id_pengguna">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="block-content block-content-full text-end bg-body">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Data --}}
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

    <script>
        
        var editButtons = document.querySelectorAll(".editButton");
        editButtons.forEach(function(editButton) {
            editButton.addEventListener("click", function() {
                var id = editButton.getAttribute("data-id");
                var name = editButton.getAttribute("data-name");
                var username = editButton.getAttribute("data-username");
                var email = editButton.getAttribute("data-email");
                var nip = editButton.getAttribute("data-nip");
    
                var modal = document.getElementById("editModal");
                var namaInput = modal.querySelector("#nama");
                var usernameInput = modal.querySelector("#username");
                var emailInput = modal.querySelector("#email");
                var nipInput = modal.querySelector("#nip");
                var idPenggunaInput = modal.querySelector("#id_pengguna");
    
                namaInput.value = name; 
                usernameInput.value = username;
                emailInput.value = email;
                nipInput.value = nip;
                idPenggunaInput.value = id;
                var editModal = new bootstrap.Modal(modal);
                editModal.show();
            });
        });
    </script>
@endsection
