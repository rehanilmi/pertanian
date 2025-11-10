<header id="mainHeader" class="shadow-sm sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1b5e20;">
        <div class="container-fluid py-2 px-3">

            <!-- Logo -->
            <div class="d-flex align-items-center logo-box">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                     width="48" height="48" class="me-3 rounded">
                <!-- Garis putih -->
                <div class="logo-divider"></div>
                <div class="text-white lh-sm ms-3">
                    <strong class="text-uppercase fs-6 d-block">DINAS PERTANIAN</strong>
                    <small class="text-uppercase" style="font-size: 12px;">KOTA PADANG</small>
                </div>
            </div>


            <!-- Hamburger -->
            <button class="navbar-toggler border-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto text-uppercase fw-semibold">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Home</a>
                    </li>

                    <!-- PROFIL DINAS -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            Profil Dinas
                        </a>

                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="#">Kepala Dinas</a></li>
                            <li><a class="dropdown-item" href="#">Visi dan Misi</a></li>
                            <li><a class="dropdown-item" href="#">Tugas dan Fungsi</a></li>
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Pejabat Struktural</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link text-white" href="#">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Pengaduan</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Proposal</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Layanan Data</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Buku Tamu</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Kontak</a></li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Login <i class="fa fa-sign-in"></i>
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>
</header>

<style>
    /* ===== NAVBAR MODERN STYLE ===== */

    /* Warna navbar sedikit lebih elegan */
    #mainHeader {
        background-color: #1b5e20;
    }

    /* Navbar link */
    .navbar-nav .nav-link {
        padding: 8px 14px;
        transition: 0.25s;
    }

    /* Hover highlight */
    .navbar-nav .nav-link:hover {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 6px;
    }

    /* Active state */
    .navbar-nav .nav-link.active {
        background: rgba(255, 255, 255, 0.18);
        border-radius: 6px;
    }

    /* Dropdown */
    .dropdown-menu {
        border-radius: 8px;
        border: none;
        padding: 6px 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        animation: fadeDropdown 0.2s ease-out;
    }

    /* Fade animation dropdown */
    @keyframes fadeDropdown {
        from {
            opacity: 0;
            transform: translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Dropdown item */
    .dropdown-menu .dropdown-item {
        padding: 8px 18px;
        font-size: 15px;
    }

    /* Hover dropdown item */
    .dropdown-menu .dropdown-item:hover {
        background: #e8f5e9;
    }

    /* Submenu level 2 */
    .dropdown-submenu {
        position: relative;
    }

    /* Show submenu on hover (desktop) */
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }

    /* Position submenu */
    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-left: -2px;
        border-radius: 8px;
    }

    /* Icon panah pada submenu */
    .dropdown-submenu > a::after {
        content: "›";
        float: right;
        font-weight: bold;
    }

    /* Sticky shadow saat scroll */
    .sticky-top.scrolled {
        box-shadow: 0 3px 10px rgba(0,0,0,0.22);
        transition: 0.3s;
    }
    /* Dropdown level 2 */
    .dropdown-submenu .dropdown-menu {
        margin-left: 0.4rem;
    }
    .dropdown-submenu:hover > .dropdown-menu {
        display: block;
    }
    /* Wrapper logo */
    .logo-box {
        gap: 10px;
    }

    /* Garis putih vertikal */
    .logo-divider {
        width: 2px;
        height: 40px;
        background-color: #ffffff;
        opacity: 0.7; /* sedikit transparan biar elegan */
    }

</style>

<script>
    document.addEventListener("scroll", function() {
        const header = document.querySelector(".sticky-top");
        if (window.scrollY > 20) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
</script>

