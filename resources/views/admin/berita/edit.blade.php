@extends('admin.app')

@section('title', 'Edit Berita')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header bg-info text-white">
            Edit Berita
        </div>

        <div class="card-body">

            {{-- FORM UPDATE TEKS --}}
            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label><strong>Judul</strong></label>
                    <input type="text" name="judul" class="form-control"
                           value="{{ $berita->judul }}" required>
                </div>

                <div class="form-group mb-3">
                    <label><strong>Isi Berita</strong></label>
                    <textarea name="isi" class="form-control" rows="6" required>{{ $berita->isi }}</textarea>
                </div>

                {{-- tombol submit versi atas (tetap ada) --}}
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save"></i> Update Berita
                </button>
            </form>

            <hr>

            {{-- FORM UPLOAD GAMBAR --}}
            <h5 class="mt-4 mb-2">Tambah Gambar</h5>

            <form action="{{ route('admin.berita.gambar.add', $berita->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <input type="file" name="gambar[]" class="form-control" multiple required>

                <button class="btn btn-success mt-3">
                    <i class="fas fa-upload"></i> Upload Gambar
                </button>
            </form>

            <hr>

            {{-- GAMBAR TERSIMPAN --}}
            <h5 class="mt-4">Gambar Tersimpan</h5>

            <div class="row mt-3">
                @forelse ($berita->images as $img)
                <div class="col-md-3 col-sm-6 text-center mb-4">

                    <img src="{{ asset('storage/'.$img->gambar) }}"
                         class="img-fluid rounded shadow-sm mb-2"
                         style="max-height:140px; object-fit:cover;">

                    <form action="{{ route('admin.berita.gambar.delete', $img->id) }}"
                          method="POST"
                          onsubmit="return confirm('Hapus gambar ini?')">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>

                </div>
                @empty
                <p class="text-muted">Belum ada gambar.</p>
                @endforelse
            </div>

            {{-- ============================================= --}}
            {{-- TOMBOL SUBMIT PALING BAWAH (PERMINTAAN KAMU) --}}
            {{-- ============================================= --}}

            <hr>

            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="judul" value="{{ $berita->judul }}">
                <input type="hidden" name="isi" value="{{ $berita->isi }}">

                <button type="submit" class="btn btn-info btn-block btn-lg">
                    <i class="fas fa-save"></i> Simpan Perubahan & Kembali
                </button>
            </form>

            {{-- ============================================= --}}

        </div>
    </div>

</div>

@endsection
