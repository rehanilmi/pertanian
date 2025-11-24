@extends('admin.app')
@section('title', 'Tambah Varietas')

@section('content')

<div class="card">
    <div class="card-header bg-success text-white">Tambah Varietas Benih</div>

    <div class="card-body">
        <form action="{{ route('admin.varieties.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Varietas</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tipe (SS, SE, FS, DS)</label>
                <input type="text" name="type" class="form-control">
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.varieties.index') }}" class="btn btn-secondary ml-2">Kembali</a>
        </form>
    </div>
</div>

@endsection
