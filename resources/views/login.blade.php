<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>Simpan - Login Page</title>

    <meta name="description"
        content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description"
        content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="{{ asset('assets/media/logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('assets/media/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/logo.png') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/oneui.min.css') }}">
</head>

<body>
    <div id="page-container">

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-image" style="background-image: url('{{ asset('assets/media/photos/logo.jpg') }}');">
                <div class="row g-0 bg-primary-dark-op">
                    <!-- Meta Info Section -->
                    <div class="hero-static col-lg-4 d-none d-lg-flex flex-column justify-content-center">
                        <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                            <div class="w-100">
                                <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                                    SIMPAN
                                </a>
                                <p class="text-white-75 me-xl-8 mt-2">
                                    Selamat Datang Di Aplikasi SIMPAN (Sistem Monitoring dan Peminjaman Aset)
                                </p>
                            </div>
                        </div>
                        <div class="p-4 p-xl-5 d-xl-flex justify-content-between align-items-center fs-sm">
                            <p class="fw-medium text-white-50 mb-0">
                            <strong></strong> &copy; <span data-toggle="year-copy"></span>, by Bapekom 6 Surabaya colaborate with MBKM Batch 6 2024
                            </p>
                        </div>
                    </div>
                    <!-- END Meta Info Section -->

                    <!-- Main Section -->
                    <div class="hero-static col-lg-8 d-flex flex-column align-items-center bg-body-extra-light">
                        <div class="p-3 w-100 d-lg-none text-center">
                            <a class="link-fx fw-semibold fs-3 text-dark" href="index.html">
                                OneUI
                            </a>
                        </div>
                        <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                            <div class="w-100">
                                <!-- Header -->
                                <div class="text-center mb-5">
                                    <p class="mb-3">
                                        <i class="fa fa-2x fa-circle-notch text-primary-light"></i>
                                    </p>
                                    <h1 class="fw-bold mb-2">
                                        Sign In
                                    </h1>
                                </div>
                                <!-- END Header -->

                                <div class="row g-0 justify-content-center">
                                    <div class="col-sm-8 col-xl-4">
                                        @if(session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                        @endif
                                        <form class="js-validation-signin" action="{{route('auth.login')}}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-4">
                                                <input type="text"
                                                    class="form-control form-control-lg form-control-alt py-3"
                                                    id="name" name="name" placeholder="Email/Username" required>
                                            </div>
                                            <div class="mb-4">
                                                <input type="password"
                                                    class="form-control form-control-lg form-control-alt py-3"
                                                    id="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <div>

                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-lg btn-alt-primary">
                                                        <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                        <div
                            class="px-4 py-3 w-100 d-lg-none d-flex flex-column flex-sm-row justify-content-between fs-sm text-center text-sm-start">
                            <p class="fw-medium text-black-50 py-2 mb-0">
                                <strong></strong> &copy; <span data-toggle="year-copy"></span>, by Bapekom 6 Surabaya colaborate with MBKM Batch 6 2024
                            </p>
                        </div>
                    </div>
                    <!-- END Main Section -->
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
    <script src="assets/js/oneui.app.min.js"></script>

    <!-- jQuery (required for jQuery Validation plugin) -->
    <script src="assets/js/lib/jquery.min.js"></script>

    <!-- Page JS Plugins -->
    <script src="assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

    <!-- Page JS Code -->
    <script src="assets/js/pages/op_auth_signin.min.js"></script>
</body>

</html>
