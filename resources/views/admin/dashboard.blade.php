@extends('admin.layout.template')

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
                        Dashboard
                    </h1>
                    <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                        Welcome <a class="fw-semibold">{{ session()->get('nama') }}</a>, everything looks great.
                    </h2>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <!-- Overview -->
            <div class="row items-push">
                <div class="col-sm-6 col-xxl-3">
                    <!-- Pending Orders -->
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{ $kategori }}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Kategori</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="far fa-rectangle-list fs-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <!-- END Pending Orders -->
                </div>
                <div class="col-sm-6 col-xxl-3">
                    <!-- New Customers -->
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{ $barang }}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Barang</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="si si-layers fs-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <!-- END New Customers -->
                </div>
                <div class="col-sm-6 col-xxl-3">
                    <!-- Messages -->
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{ $peminjaman }}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Total Peminjaman</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-hand-holding fs-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <!-- END Messages -->
                </div>
                <div class="col-sm-6 col-xxl-3">
                    <!-- Conversion Rate -->
                    <div class="block block-rounded d-flex flex-column h-100 mb-0">
                        <div
                            class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                                <dt class="fs-3 fw-bold">{{ $berlangsung }}</dt>
                                <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Peminjaman Berlangsung</dd>
                            </dl>
                            <div class="item item-rounded-lg bg-body-light">
                                <i class="fa fa-clock fs-3 text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <!-- END Conversion Rate-->
                </div>
            </div>
            <!-- END Overview -->

            <!-- Recent Orders -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Peminjaman Terbaru</h3>
                    <div class="block-options space-x-1">
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <!-- Recent Orders Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr class="text-center">
                                    <th class="d-xl-table-cell">Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th class="d-sm-table-cell">Tanggal Kembali</th>
                                    <th class="d-sm-table-cell">Status</th>
                                </tr>
                            </thead>
                            <tbody class="fs-sm">
                                @foreach ($terbaru as $data)
                                    <tr class="text-center">
                                        <td class="d-xl-table-cell">
                                            <p class="fs-sm fw-medium text-muted mb-0">{{ $data->peminjam }}</p>
                                        </td>
                                        <td>
                                            {{ Carbon::parse($data->tanggal_pinjam)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="d-sm-table-cell">
                                            @if ($data->status === '0')
                                            {{ Carbon::parse($data->tanggal_kembali)->locale('id')->translatedFormat('d F Y') }}
                                            @else
                                            {{ Carbon::parse($data->updated_at)->locale('id')->translatedFormat('d F Y') }}
                                            @endif
                                        </td>
                                        <td class="d-sm-table-cell fw-semibold text-muted">
                                            @if ($data->status === '0')
                                                <span
                                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-danger">Sedang
                                                    Berlangsung</span>
                                            @else
                                                <span
                                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success text-white">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                    <!-- END Recent Orders Table -->
                </div>
            </div>
            <!-- END Recent Orders -->
        </div>
        <!-- END Page Content -->
    </main>
@endsection
