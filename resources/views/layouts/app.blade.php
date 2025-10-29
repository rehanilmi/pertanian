<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dinas Pertanian Kota Padang')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
@include('layouts.partials.header')

<main>
    @yield('content')
</main>

@include('layouts.partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    window.addEventListener("scroll", function() {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
    }

    /* ===== Header + Navbar ===== */
    #mainHeader {
        z-index: 1050;
    }

    .navbar {
        padding-top: 0.4rem;
        padding-bottom: 0.4rem;
        transition: all 0.3s ease;
    }

    /* === NAV MENU STYLE (kecil & rapi) === */
    .nav-link {
        color: #fff !important;
        font-size: 13px;             /* ukuran teks kecil dan profesional */
        letter-spacing: 0.3px;       /* jarak antar huruf sedikit renggang */
        padding: 8px 12px !important;/* rapikan jarak antar item */
        font-weight: 600;            /* tetap tegas tapi tidak besar */
        transition: all 0.2s ease;
    }

    .nav-link:hover,
    .dropdown-item:hover {
        background-color: #256428 !important;
        color: #fff !important;
    }

    /* Dropdown styling */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }

    .dropdown-item {
        font-size: 13px;             /* dropdown ikut kecil */
        padding: 6px 14px;
    }

    /* Search form */
    form input {
        width: 100%;
        min-width: 160px;
        font-size: 13px;             /* agar selaras dengan menu */
    }
    form button {
        background-color: #1b5e20;
        border: none;
        font-size: 13px;
    }

    /* RESPONSIVE FIX */
    @media (max-width: 991.98px) {
        .navbar-nav {
            background-color: #1b5e20;
            padding: 1rem 0;
        }

        .nav-link {
            display: block;
            text-align: center;
            padding: 0.75rem;
            font-size: 15px;          /* sedikit lebih besar di HP agar terbaca */
        }

        .dropdown-menu {
            background-color: #155a1a;
        }

        form {
            width: 100%;
        }

        form input {
            width: 100%;
        }

        .small.text-white {
            text-align: center;
            width: 100%;
        }
    }

    /* Scroll effect */
    .navbar.scrolled {
        background-color: #155a1a !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.25);
    }

    footer {
        font-size: 14px;
        background-color: #2e4528 !important;
    }
    footer ul li:hover {
        color: #a8e6a3;
        cursor: pointer;
    }
    footer a:hover {
        color: #a8e6a3 !important;
    }


</style>


</html>
