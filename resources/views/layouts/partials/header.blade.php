<header id="mainHeader" class="shadow-sm sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1b5e20;">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap py-2 px-3">

            {{-- Kiri: Logo dan Nama --}}
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/logopertanian.jpeg') }}" alt="Logo" width="48" height="48" class="me-2 rounded">
                <div class="text-white lh-sm">
                    <strong class="text-uppercase d-block fs-6">DINAS PERTANIAN</strong>
                    <small class="text-uppercase" style="font-size: 12px;">KOTA PADANG</small>
                </div>
            </div>

            {{-- Tombol Hamburger --}}
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu Navigasi --}}
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto text-uppercase fw-semibold text-center">
                    <li class="nav-item"><a class="nav-link text-white" href="/">Beranda</a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Pejabat</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Program</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Ketahanan Pangan</a></li>
                            <li><a class="dropdown-item" href="#">Hortikultura</a></li>
                            <li><a class="dropdown-item" href="#">Perkebunan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item"><a class="nav-link text-white" href="#">Publikasi</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Informasi Publik</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Kontak Kami</a></li>
                </ul>

                {{-- Kanan: Search & Link Cepat --}}
                <div class="d-flex align-items-center justify-content-end flex-wrap gap-2 mt-2 mt-lg-0">
                    <form class="d-flex align-items-center" style="max-width: 250px;">
                        <input type="text" class="form-control form-control-sm bg-light border-0 rounded-start-pill px-3"
                               placeholder="Cari di situs ini...">
                        <button class="btn btn-dark btn-sm rounded-end-pill px-3">Cari</button>
                    </form>

                    <div class="small text-white text-nowrap ms-lg-2">
                        <a href="#" class="text-white text-decoration-none me-2">FAQ</a> |
                        <a href="#" class="text-white text-decoration-none mx-2">WEBMAIL</a>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</header>
