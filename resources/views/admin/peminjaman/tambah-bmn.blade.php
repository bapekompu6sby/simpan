@extends('admin.layout.template')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <style>
        .table-responsive table th,
        .table-responsive table td {
            padding: 1rem;
        }

        .table-responsive table th {
            width: auto;
        }

        .table-responsive table td input,
        .table-responsive table td select,
        .table-responsive table td textarea {
            width: 100%;
        }
    </style>
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

                </div>
            </div>
        </div>

        <form action="{{ route('admin.peminjaman.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <!-- Floating Labels -->
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="mt-2 mb-4">
                            <a href="{{ route('admin.peminjaman.tambah') }}" class="btn {{ Route::currentRouteName() === 'admin.peminjaman.tambah' ? 'btn-dark' : 'btn-outline-dark' }}  rounded-pill">BMN</a>
                            <a href="{{ route('admin.peminjaman.tambah-kendaraan') }}" class="btn {{ Route::currentRouteName() === 'admin.peminjaman.tambah-kendaraan' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill">Kendaraan</a>
                            <a href="{{ route('admin.peminjaman.tambah-laptop') }}" class="btn {{ Route::currentRouteName() === 'admin.peminjaman.tambah-laptop' ? 'btn-dark' : 'btn-outline-dark' }} rounded-pill">Laptop</a>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="peminjam" name="peminjam"
                                    placeholder="Nama Peminjam" required>
                                <label for="peminjam">Nama Peminjam</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" id="nip" name="nip" placeholder="NIP"
                                    required>
                                <label for="nip">NIP</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="instansi" name="instansi"
                                    placeholder="Asal Instansi" required>
                                <label for="instansi">Asal Instansi</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="alamat" name="alamat" style="height: 100px" placeholder="Masukkan Alamat"
                                    required></textarea>
                                <label for="alamat">Alamat</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="tel" class="form-control" id="no_telp" name="no_telp"
                                    placeholder="No Telepon" required pattern="\d*">
                                <label for="no_telp">Nomor Telepon</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="js-flatpickr form-control" id="tanggal" name="tanggal"
                                    placeholder="Pilih Rentang Tanggal" data-mode="range"
                                    data-date-format="d/m/Y" required>
                                <label for="tanggal_kembali">Pilih Tanggal</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 50px" placeholder="Tulis Deskripsi Disini"
                                    required></textarea>
                                <label for="deskripsi">Keperluan</label>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="id_penandatangan">Yang mengetahui</label>
                                <select class="js-select2 form-select" id="id_penandatangan" name="id_penandatangan" data-placeholder="Pilih Penandatangan" required>
                                    <option></option>
                                    @foreach ($penandatangan as $data)
                                        <option value="{{ $data->id_penandatangan }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
        
                            </div>
                            <input type="hidden" name="tipe" value="BMN">
                        </div>
                    </div>
                </div>
                <!-- END Floating Labels -->

                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Rincian Barang</h3>
                        <button type="button" class="btn btn-success btn-sm btn-tambah"><i
                                class="fas fa-plus"></i></button>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Barang </th>
                                        <th>NUP </th>
                                        <th>Lokasi Awal</th>
                                        <th>Lokasi Tujuan</th>
                                        <th>Deskripsi</th>
                                        <th class="text-center"></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="mt-2 text-end">
                            <button type="submit" class="btn btn-primary" style="display: none"
                                id="submitButton">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection

@section('javascript')
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flatpickr/l10n/id.js') }}"></script>
    <script>
        document.getElementById('no_telp').addEventListener('input', function(e) {
            const value = e.target.value;
            e.target.value = value.replace(/\D/g, '').substring(0, 14);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            One.helpersOnLoad(['jq-select2', 'js-flatpickr']);
            const addButton = document.querySelector('.btn-tambah');
            const tableBody = document.querySelector('tbody');
            const submitButton = document.getElementById('submitButton');
            const form = document.querySelector('form');

            function toggleSubmitButton() {
                if (tableBody.children.length === 0) {
                    submitButton.style.display = 'none';
                } else {
                    submitButton.style.display = 'inline-block';
                }
            }

            addButton.addEventListener('click', function() {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>
                    <select class="js-select2 form-select select-barang" name="id_barang[]" style="width:230px;" required>
                        <option value="" selected disabled>Pilih Barang</option>
                        @foreach ($nama_barang as $nama_brg)
                            <option value="{{ $nama_brg->nama_barang }}">{{ $nama_brg->nama_barang }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select class="js-select2 form-select select-nup" name="nup[]" style="width:100px;" required>
                        <option value="" selected disabled>NUP</option>
                    </select>
                </td>
                <td><input type="text" class="form-control lokasi-awal" style="width:250px;" required name="lokasi_awal[]" placeholder="Lokasi Awal"></td>
                <td><input type="text" class="form-control" style="width:250px;" required name="lokasi_akhir[]" placeholder="Lokasi Tujuan"></td>
                <td><textarea class="form-control" name="deskripsi_barang[]" style="width:250px;" placeholder="Deskripsi" rows="1"></textarea></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-times"></i></button></td>
                `;
                tableBody.appendChild(newRow);
                const selectElement = $(newRow).find('.select-barang');
                selectElement.select2();

                selectElement.on('change', function() {
                    const name = this.value;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content');
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/administrator/aset/get-nup', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const data = JSON.parse(xhr.responseText);
                            const nupSelect = newRow.querySelector('.select-nup');
                            nupSelect.innerHTML =
                                '<option value="" selected disabled>NUP</option>';

                            data.forEach(item => {
                                const option = document.createElement('option');
                                option.value = item.id_barang;
                                option.textContent = item.nup;
                                nupSelect.appendChild(option);
                            });

                            $(nupSelect).select2();
                        }
                    };
                    xhr.send(JSON.stringify({
                        name: name
                    }));
                });

                const selectNup = $(newRow).find('.select-nup');
                selectNup.on('change', function() {
                    const selectedId = this.value;
                    const xhr = new XMLHttpRequest();
                    xhr.open('GET', `/administrator/get-lokasi/${selectedId}`, true);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            const data = JSON.parse(xhr.responseText);
                            const lokasiAwalInput = newRow.querySelector('.lokasi-awal');
                            if (data.lokasi) {
                                lokasiAwalInput.value = data.lokasi;
                                lokasiAwalInput.placeholder = "Lokasi Awal";
                                lokasiAwalInput.readOnly = true;
                            } else {
                                lokasiAwalInput.value = '';
                                lokasiAwalInput.placeholder = "Tentukan Lokasi";
                                lokasiAwalInput.readOnly = false;
                            }
                        }
                    };
                    xhr.send();
                });
                toggleSubmitButton();
                newRow.querySelector('.delete-row').addEventListener('click', function() {
                    tableBody.removeChild(newRow);
                    toggleSubmitButton();
                });
            });

            form.addEventListener('submit', function(event) {
                var tanggalInput = document.getElementById('tanggal').value;
                if (tableBody.children.length === 0) {
                    event.preventDefault();
                    alert('Anda harus menambahkan minimal satu baris.');
                }else if (!tanggalInput) {
                    alert("Tanggal Harus Diisi!");
                    event.preventDefault();
                }
            });

            toggleSubmitButton();
        });
    </script>
@endsection
