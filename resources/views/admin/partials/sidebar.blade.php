<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-bold text-white">Admin Panel</span>
    </a>

    <div class="sidebar">

        {{-- User --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('images/avatar4.png') }}" class="img-circle elevation-2" alt="User">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->name ?? 'Administrator' }}
                </a>
            </div>
        </div>

        {{-- Search --}}
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>

        {{-- Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- BERITA --}}
                <li class="nav-item">
                    <a href="{{ route('admin.berita.index') }}"
                       class="nav-link {{ request()->is('admin/berita*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Berita</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.suppliers.index') }}"
                       class="nav-link {{ request()->is('admin/suppliers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>Supplier</p>
                    </a>
                </li>

                {{-- VARIETAS BENIH --}}
                <li class="nav-item">
                    <a href="{{ route('admin.varieties.index') }}"
                       class="nav-link {{ request()->is('admin/varieties*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>Varietas Benih</p>
                    </a>
                </li>

                {{-- STOK SUPPLIER --}}
                <li class="nav-item">
                    <a href="{{ route('admin.supplier_stocks.index') }}"
                       class="nav-link {{ request()->is('admin/stocks*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Stok Benih</p>
                    </a>
                </li>


                {{-- LOGOUT --}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link w-100 text-left btn btn-link text-white">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p class="d-inline">Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>

    </div>
</aside>
