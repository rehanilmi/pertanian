@extends('admin.app')

@section('title', 'List Berita')

@section('content')

{{-- FONT AWESOME WAJIB AGAR ICON TAMPIL --}}
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

{{-- CUSTOM CSS --}}
<style>
    /* Pagination styling compact */
    .pagination {
        margin: 0 !important;
    }

    .pagination li a,
    .pagination li span {
        padding: 4px 10px !important;
        font-size: 13px !important;
        border-radius: 3px !important;
    }

    .page-item.active .page-link {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
    }

    .page-item .page-link {
        color: #007bff;
    }

    .page-item.disabled .page-link {
        color: #bbb !important;
    }
</style>

<div class="container-fluid">

    <h4 class="mb-3">Berita</h4>

    <div class="row">

        {{-- ========================= --}}
        {{-- MENU KIRI --}}
        {{-- ========================= --}}
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-success text-white">
                    Menu
                </div>

                <ul class="list-group list-group-flush">

                    <a href="{{ route('admin.berita.index') }}"
                       class="list-group-item list-group-item-action active">
                        <i class="fas fa-list mr-2"></i> List Berita
                    </a>

                    <a href="{{ route('admin.berita.create') }}"
                       class="list-group-item list-group-item-action">
                        <i class="fas fa-plus mr-2"></i> Tambah Berita
                    </a>

                    <a href="#"
                       class="list-group-item list-group-item-action">
                        <i class="fas fa-tags mr-2"></i> List Kategori Berita
                    </a>

                    <a href="#"
                       class="list-group-item list-group-item-action">
                        <i class="fas fa-plus mr-2"></i> Tambah Kategori Berita
                    </a>

                </ul>
            </div>
        </div>

        {{-- ========================= --}}
        {{-- LIST BERITA KANAN --}}
        {{-- ========================= --}}
        <div class="col-md-9">

            <div class="card">

                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <h5 class="mb-0">List Berita</h5>

                    {{-- SEARCH --}}
                    <form action="{{ route('admin.berita.index') }}" method="GET" class="d-flex" style="gap:6px;">
                        <input type="text" name="search"
                               class="form-control form-control-sm"
                               placeholder="Cari berita..."
                               value="{{ request('search') }}"
                               style="max-width: 220px; border-radius: 6px;">

                        <button class="btn btn-sm"
                                style="background:#20c997; color:white; border-radius:6px;">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>

                </div>

                {{-- ========================= --}}
                {{-- TABLE --}}
                {{-- ========================= --}}
                <div class="card-body p-0">
                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Judul Berita</th>
                            <th style="width: 140px;">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($beritas as $i => $b)
                        <tr>
                            <td class="text-center">
                                {{ $beritas->firstItem() + $i }}
                            </td>

                            <td>{{ $b->judul }}</td>

                            {{-- ========================= --}}
                            {{-- KOLUM A K S I (LIKE SCREENSHOT) --}}
                            {{-- ========================= --}}
                            <td class="text-center" style="white-space: nowrap;">

                                {{-- EDIT BUTTON --}}
                                <a href="{{ route('admin.berita.edit', $b->id) }}"
                                   style="
                                       background:#1ca3db;
                                       width:28px;
                                       height:28px;
                                       display:inline-flex;
                                       align-items:center;
                                       justify-content:center;
                                       border-radius:4px;
                                       color:white;
                                       margin-right:6px;
                                   ">
                                    <i class="fas fa-edit" style="font-size:13px;"></i>
                                </a>

                                {{-- DELETE BUTTON --}}
                                <form action="{{ route('admin.berita.destroy', $b->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus berita ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="
                                            background:#e74c3c;
                                            width:28px;
                                            height:28px;
                                            display:inline-flex;
                                            align-items:center;
                                            justify-content:center;
                                            border-radius:4px;
                                            color:white;
                                            border:none;
                                        ">
                                        <i class="fas fa-trash" style="font-size:13px;"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach

                        @if ($beritas->count() == 0)
                        <tr>
                            <td colspan="3" class="text-center p-3 text-muted">
                                Tidak ada data berita.
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                {{-- ========================= --}}
                {{-- PAGINATION + SHOWING TEXT --}}
                {{-- ========================= --}}
                <div class="card-footer d-flex justify-content-between align-items-center">

                    <div style="font-size: 13px; color:#555;">
                        Showing {{ $beritas->firstItem() }} to {{ $beritas->lastItem() }}
                        of {{ $beritas->total() }} entries
                    </div>

                    <div>
                        {{ $beritas->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
