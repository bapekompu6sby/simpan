@extends('admin.layout.template')

@section('content')
    <main id="main-container">
        <!-- Hero -->
        <div class="content">
            <a href="/administrator/aset" class="btn btn-sm btn-danger text-start">Kembali</a>
            <div
                class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
                <div class="flex-grow-1 mb-1 mb-md-0">

                    <h1 class="h3 fw-bold mb-1 mt-2">
                        Import Data Aset
                    </h1>
                </div>
                <div class="mt-3 mt-md-0 ms-md-3 space-x-1">

                </div>
            </div>
        </div>

        <div class="content">
            <!-- Floating Labels -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Import Data Aset</h3>
                </div>
                <div class="block-content block-content-full">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3 col-sm-0"></div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="id_kategori" name="id_kategori" required>
                                        <option selected value="" disabled>Pilih Kategori</option>
                                        @foreach ($kategori as $ktg)
                                            <option value="{{ $ktg->id_kategori }}">{{ $ktg->nama_kategori }}</option>    
                                        @endforeach
                                    </select>
                                    <label for="example-select-floating">Kategori</label>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="example-file-input">Masukkan FIle Excel</label>
                                    <input class="form-control" type="file" name="file" id="excel">
                                    <span>Format file excel dapat di download <a href="{{asset('assets/format/import_aset.xlsx')}}">disini</a></span>
                                </div>
                                <div class="mb-4 text-end">
                                    <input class="btn btn-primary text-end" type="submit" value="Submit">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-0"></div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Floating Labels -->
        </div>
    </main>
@endsection
