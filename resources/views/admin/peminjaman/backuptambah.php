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
            /* Allows table header to resize based on content */
        }

        .table-responsive table td input,
        .table-responsive table td select,
        .table-responsive table td textarea {
            width: 100%;
            /* Make input fields full width */
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
                    <!-- Additional buttons or content can go here -->
                </div>
            </div>
        </div>

        <form action="{{ route('admin.peminjaman.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <!-- Floating Labels -->
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <div class="col-12">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="peminjam" name="peminjam"
                                    placeholder="Nama Peminjam" required>
                                <label for="peminjam">Nama Peminjam</label>
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
                                <input type="text" class="js-flatpickr form-control" id="tanggal"
                                    name="tanggal" placeholder="Pilih Rentang Tanggal" data-mode="range"
                                    data-min-date="today" data-date-format="d/m/Y" required>
                                <label for="tanggal_kembali">Pilih Tanggal</label>
                            </div>
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="deskripsi" name="deskripsi" style="height: 50px" placeholder="Tulis Deskripsi Disini"
                                    required></textarea>
                                <label for="deskripsi">Keperluan</label>
                            </div>
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
                                        <th>Barang (NUP)</th>
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
    <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
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
                    <select class="js-select2 form-select" name="id_barang[]" style="width:250px;" required>
                        <option value="" selected disabled>Pilih Barang</option>
                        @foreach ($barang as $brg)
                            <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }} ({{ $brg->nup }})</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" class="form-control lokasi-awal" style="width:250px;" required name="lokasi_awal[]" placeholder="Lokasi Awal"></td>
                <td><input type="text" class="form-control" style="width:250px;" required name="lokasi_akhir[]" placeholder="Lokasi Tujuan"></td>
                <td><textarea class="form-control" name="deskripsi_barang[]" style="width:250px;" placeholder="Deskripsi" rows="1"></textarea></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-row"><i class="fas fa-times"></i></button></td>
                `;
                tableBody.appendChild(newRow);
                const selectElement = $(newRow).find('.js-select2');
                selectElement.select2();

                selectElement.on('change', function() {
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
                        } else {
                            console.error('Error fetching data:', xhr.statusText);
                        }
                    };
                    xhr.onerror = function() {
                        console.error('Request failed');
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
                if (tableBody.children.length === 0) {
                    event.preventDefault();
                    alert('Anda harus menambahkan minimal satu baris.');
                }
            });

            toggleSubmitButton();
        });
    </script>
@endsection
