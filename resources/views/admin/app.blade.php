<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Admin Panel</title>

    {{-- ====== CSS LOCAL SESUAI FOLDER ABANG ====== --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        .navbar-green { background-color: #20c997 !important; }
        .main-footer { background-color: #20c997 !important; color: #fff !important; }
        .nav-link.active { background-color: #20c997 !important; color: #fff !important; }
        .card-header {
            background-color: #20c997 !important;
            color: white !important;
        }
        /* ==================================================== */
        /*               KECILKAN SEMUA TULISAN SIDEBAR         */
        /* ==================================================== */
        .main-sidebar,
        .main-sidebar .nav-sidebar .nav-link,
        .main-sidebar .brand-link,
        .main-sidebar .user-panel .info a,
        .main-sidebar .nav-header,
        .main-sidebar .form-control-sidebar,
        .main-sidebar .btn-sidebar {
            font-size: 13px !important;
        }

        /* Icon sidebar lebih kecil */
        .main-sidebar .nav-icon {
            font-size: 14px !important;
        }

        /* Brand text "Admin Panel" */
        .brand-link .brand-text {
            font-size: 14px !important;
        }

        /* Nama user */
        .user-panel .info a {
            font-size: 13px !important;
        }

        /* Padding menu sidebar lebih kecil */
        .nav-sidebar .nav-link {
            padding-top: 6px !important;
            padding-bottom: 6px !important;
        }

        /* Search box sidebar */
        .form-control-sidebar {
            height: 32px !important;
            font-size: 12px !important;
        }

        /* Search button icon */
        .btn-sidebar i {
            font-size: 12px !important;
        }

        /* ==================================================== */
        /*        KECILKAN SEMUA TULISAN DI KONTEN HALAMAN      */
        /* ==================================================== */
        .content-wrapper,
        .content-wrapper .card,
        .content-wrapper table,
        .content-wrapper .card-header,
        .content-wrapper .card-body,
        .content-wrapper .card-footer,
        .content-wrapper .list-group-item,
        .content-wrapper input,
        .content-wrapper button,
        .content-wrapper select,
        .content-wrapper textarea {
            font-size: 13px !important;
        }

        /* Judul di konten, seperti "Berita", "List Berita" */
        .content-wrapper h1,
        .content-wrapper h2,
        .content-wrapper h3,
        .content-wrapper h4,
        .content-wrapper h5 {
            font-size: 16px !important;
            font-weight: 600 !important;
        }

        /* Header table */
        .table thead th {
            font-size: 13px !important;
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }

        /* Isi table */
        .table tbody td {
            font-size: 13px !important;
            padding-top: 7px !important;
            padding-bottom: 7px !important;
        }

        /* Pagination kecil */
        .pagination li a,
        .pagination li span {
            font-size: 12px !important;
            padding: 4px 10px !important;
        }

        .page-item.active .page-link {
            background-color: #007bff !important;
            border-color: #007bff !important;
            color: white !important;
        }

        /* Search input kanan */
        .input-group input {
            height: 32px !important;
            font-size: 13px !important;
        }

        /* Search icon */
        .input-group .btn i {
            font-size: 12px !important;
        }

        /* Card header padding */
        .card-header {
            padding: 8px 15px !important;
        }

        /* Card body padding */
        .card-body {
            padding: 12px !important;
        }

        /* List menu kiri (card menu) */
        .list-group-item {
            font-size: 13px !important;
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }
    </style>

    {{-- Place for page-specific CSS --}}
    @yield('head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.partials.navbar')
    @include('admin.partials.sidebar')

    <div class="content-wrapper p-3">
        @yield('content')
    </div>

    @include('admin.partials.footer')

</div>

{{-- ====== JS LOCAL SESUAI FOLDER ABANG ====== --}}
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

{{-- Page-specific JS --}}
@yield('script')

</body>
</html>
