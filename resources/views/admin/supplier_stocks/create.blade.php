@extends('admin.app')

@section('title','Tambah Stok Benih')

@section('content')

<div class="container-fluid">

    <h4 class="mb-3">Tambah Stok Benih</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card">

                <div class="card-header bg-success text-white">Tambah Stok</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.supplier_stocks.store') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                @foreach($suppliers as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Varietas</label>
                            <select name="variety_id" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                @foreach($varieties as $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Jumlah (kg)</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Satuan</label>
                            <input type="text" name="unit" value="kg" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Harga (opsional)</label>
                            <input type="number" name="price" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Tanggal Stok</label>
                            <input type="date" name="stock_date" class="form-control">
                        </div>

                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('admin.supplier_stocks.index') }}" class="btn btn-secondary ml-2">Kembali</a>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
