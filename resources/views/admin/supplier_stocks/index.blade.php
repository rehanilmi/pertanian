@extends('admin.app')

@section('title', 'Stok Benih')

@section('content')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid">

    <h4 class="mb-3">Stok Benih Supplier</h4>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">Menu</div>

                <ul class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action active"
                       href="{{ route('admin.supplier_stocks.index') }}">
                        <i class="fas fa-database mr-2"></i> List Stok
                    </a>

                    <a class="list-group-item list-group-item-action"
                       href="{{ route('admin.supplier_stocks.create') }}">
                        <i class="fas fa-plus mr-2"></i> Tambah Stok
                    </a>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">

                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Stok Benih</h5>
                </div>

                <div class="card-body p-0">
                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Supplier</th>
                            <th>Varietas</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th width="120px">Aksi</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($stocks as $i => $s)
                        <tr>
                            <td class="text-center">{{ $stocks->firstItem() + $i }}</td>

                            <td>{{ $s->supplier->name }}</td>
                            <td>{{ $s->variety->name }}</td>

                            <td>{{ $s->quantity }} {{ $s->unit }}</td>

                            <td>{{ $s->stock_date ?? '-' }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.supplier_stocks.edit', $s->id) }}"
                                   class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>

                                <form action="{{ route('admin.supplier_stocks.destroy', $s->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus stok ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>

                                <button class="btn btn-sm btn-success mt-1"
                                        onclick="openStockModal('{{ $s->id }}', 'IN')">➕</button>

                                <button class="btn btn-sm btn-warning mt-1"
                                        onclick="openStockModal('{{ $s->id }}', 'OUT')">➖</button>

                                <a href="{{ route('admin.supplier_stocks.logs', ['supplier_stock_id' => $s->id]) }}"
                                   class="btn btn-sm btn-info mt-1">
                                    <i class="fas fa-history"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                        @if($stocks->count() == 0)
                        <tr>
                            <td colspan="6" class="text-center p-3 text-muted">
                                Tidak ada stok.
                            </td>
                        </tr>
                        @endif

                        </tbody>
                    </table>

                    <!-- MODAL UPDATE STOK -->
                    <div class="modal fade" id="stockModal" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.supplier_stocks.updateStock') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="modalTitle">Update Stok</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">

                                        <input type="hidden" name="supplier_stock_id" id="modalStockId">
                                        <input type="hidden" name="change_type" id="modalType">

                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" min="1" class="form-control" name="quantity" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Catatan (opsional)</label>
                                            <textarea class="form-control" name="note"></textarea>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success">Simpan</button>
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    {{ $stocks->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    function openStockModal(stockId, type) {
        document.getElementById("modalStockId").value = stockId;
        document.getElementById("modalType").value = type;

        document.getElementById("modalTitle").innerText =
            (type === "IN") ? "Tambah Stok" : "Kurangi Stok";

        $("#stockModal").modal('show');
    }
</script>

@endsection
