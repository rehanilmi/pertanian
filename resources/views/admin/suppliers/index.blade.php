@extends('admin.app')

@section('title', 'List Supplier')

@section('content')

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .pagination { margin: 0 !important; }
    .pagination li a, .pagination li span {
        padding: 4px 10px !important;
        font-size: 13px !important;
        border-radius: 3px !important;
    }
    .page-item.active .page-link {
        background-color: #007bff !important;
        border-color: #007bff !important;
        color: white !important;
    }
    .page-item .page-link { color: #007bff; }
    .page-item.disabled .page-link { color: #bbb !important; }
</style>

<div class="container-fluid">

    <h4 class="mb-3">Supplier</h4>

    <div class="row">

        {{-- ========================= --}}
        {{-- MENU KIRI --}}
        {{-- ========================= --}}
        <div class="col-md-3">

            <div class="card">
                <div class="card-header bg-success text-white">Menu</div>

                <ul class="list-group list-group-flush">

                    <a href="{{ route('admin.suppliers.index') }}"
                       class="list-group-item list-group-item-action active">
                        <i class="fas fa-list mr-2"></i> List Supplier
                    </a>

                    <a href="{{ route('admin.suppliers.create') }}"
                       class="list-group-item list-group-item-action">
                        <i class="fas fa-plus mr-2"></i> Tambah Supplier
                    </a>

                </ul>
            </div>

        </div>

        {{-- ========================= --}}
        {{-- LIST SUPPLIER KANAN --}}
        {{-- ========================= --}}
        <div class="col-md-9">

            <div class="card">

                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <h5 class="mb-0">List Supplier</h5>

                    {{-- SEARCH --}}
                    <form action="{{ route('admin.suppliers.index') }}"
                          method="GET"
                          class="d-flex"
                          style="gap:6px;">

                        <input type="text"
                               name="search"
                               class="form-control form-control-sm"
                               placeholder="Cari supplier..."
                               value="{{ request('search') }}"
                               style="max-width: 220px; border-radius: 6px;">

                        <button class="btn btn-sm"
                                style="background:#20c997; color:white; border-radius:6px;">
                            <i class="fas fa-search"></i>
                        </button>

                    </form>

                </div>

                {{-- ========================= --}}
                {{-- TABEL --}}
                {{-- ========================= --}}
                <div class="card-body p-0">

                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Kabupaten</th>
                            <th>Provinsi</th>
                            <th width="120">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach ($suppliers as $i => $s)
                        <tr>
                            <td class="text-center">{{ $suppliers->firstItem() + $i }}</td>

                            <td>{{ $s->name }}</td>
                            <td>{{ $s->type->name ?? '-' }}</td>

                            <td>{{ $s->district->name ?? '-' }}</td>
                            <td>{{ $s->village->name ?? '-' }}</td>

                            <td>{{ $s->district->regency->name ?? '-' }}</td>
                            <td>{{ $s->district->regency->province->name ?? '-' }}</td>

                            {{-- ACTION BUTTONS --}}
                            <td class="text-center" style="white-space: nowrap;">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.suppliers.edit', $s->id) }}"
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

                                {{-- DELETE --}}
                                <form action="{{ route('admin.suppliers.destroy', $s->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus supplier ini?')">

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

                        {{-- NO DATA --}}
                        @if ($suppliers->count() == 0)
                        <tr>
                            <td colspan="8" class="text-center p-3 text-muted">
                                Tidak ada data supplier.
                            </td>
                        </tr>
                        @endif

                        </tbody>
                    </table>

                </div>

                {{-- ========================= --}}
                {{-- PAGINATION --}}
                {{-- ========================= --}}
                <div class="card-footer d-flex justify-content-between align-items-center">

                    <div style="font-size: 13px; color:#555;">
                        Showing {{ $suppliers->firstItem() }} to {{ $suppliers->lastItem() }}
                        of {{ $suppliers->total() }} entries
                    </div>

                    <div>
                        {{ $suppliers->onEachSide(1)->links('pagination::bootstrap-4') }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
