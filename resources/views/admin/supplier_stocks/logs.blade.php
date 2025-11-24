@extends('admin.app')

@section('title', 'Riwayat Perubahan Stok')

@section('content')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="container-fluid">

    <h4 class="mb-3">Riwayat Perubahan Stok</h4>

    <div class="row">

        {{-- MENU KIRI --}}
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">Menu</div>

                <ul class="list-group list-group-flush">
                    <a href="{{ route('admin.supplier_stocks.index') }}"
                       class="list-group-item list-group-item-action">
                        <i class="fas fa-database mr-2"></i> List Stok
                    </a>

                    <a href="{{ route('admin.supplier_stocks.logs') }}"
                       class="list-group-item list-group-item-action active">
                        <i class="fas fa-history mr-2"></i> Riwayat Stok
                    </a>
                </ul>
            </div>
        </div>

        {{-- KONTEN LOGS --}}
        <div class="col-md-9">
            <div class="card">

                <div class="card-header bg-success text-white d-flex justify-content-between">
                    <h5 class="mb-0">Riwayat Stok per Data Stok</h5>
                </div>

                <div class="card-body">

                    {{-- FILTER STOCK --}}
                    <form method="GET" action="" class="form-inline mb-3">
                        <label class="mr-2">Pilih Data Stok:</label>
                        <select name="supplier_stock_id" class="form-control mr-2" onchange="this.form.submit()">
                            <option value="">-- Pilih Data Stok --</option>
                            @foreach($stocks as $st)
                            <option value="{{ $st->id }}" {{ $stockId == $st->id ? 'selected' : '' }}>
                                {{ $st->supplier->name }} - {{ $st->variety->name }} ({{ $st->quantity }} {{ $st->unit }})
                            </option>
                            @endforeach
                        </select>
                    </form>

                    {{-- TABEL LOGS --}}
                    <table class="table table-bordered">
                        <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($logs as $i => $log)
                        <tr>
                            <td class="text-center">{{ $logs->firstItem() + $i }}</td>
                            <td class="text-center">
                                @if($log->change_type === 'IN')
                                <span class="badge badge-success">IN (+)</span>
                                @else
                                <span class="badge badge-danger">OUT (-)</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $log->quantity }} kg</td>
                            <td>{{ $log->note ?? '-' }}</td>
                            <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-3 text-muted">Tidak ada log.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>

                @if($logs instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="card-footer">
                    {{ $logs->links('pagination::bootstrap-4') }}
                </div>
                @endif

            </div>
        </div>
    </div>

</div>
@endsection
