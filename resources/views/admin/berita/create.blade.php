@extends('admin.app')

@section('title','Tambah Berita')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">Tambah Berita</div>

    <div class="card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control">
            </div>

            <div class="form-group">
                <label>Isi</label>
                <textarea name="isi" rows="5" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Simpan</button>

            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary ml-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>
@endsection
