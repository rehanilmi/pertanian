@extends('layouts.app')

@section('title', $berita->judul)

@section('content')

<div class="container py-5">

    <div class="row g-4">

        <!-- ========================= -->
        <!--  KONTEN BERITA            -->
        <!-- ========================= -->
        <div class="col-lg-8">

            <!-- Judul -->
            <h1 class="fw-bold mb-2">{{ $berita->judul }}</h1>

            <!-- Tanggal -->
            <p class="text-muted small">
                Dipublikasikan pada {{ $berita->created_at->format('d M Y') }}
            </p>

            <!-- Gambar utama (thumbnail dari berita_images) -->
            @php
            $thumbnail = $berita->images->first();
            @endphp

            <img src="{{ $thumbnail ? asset('storage/' . $thumbnail->gambar) : asset('images/default.jpg') }}"
                 class="img-fluid rounded mb-4 shadow"
                 style="max-height: 450px; object-fit: cover; width:100%;">

            <!-- Isi berita -->
            <article class="mb-5" style="line-height:1.7; font-size: 17px;">
                {!! $berita->isi !!}
            </article>

            <!-- Share -->
            <div class="d-flex gap-2 mt-4">
                <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                   target="_blank"
                   class="btn btn-success btn-sm">
                    Bagikan ke WhatsApp
                </a>

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                   target="_blank"
                   class="btn btn-primary btn-sm">
                    Bagikan ke Facebook
                </a>
            </div>

            <!-- Jika berita punya banyak gambar, tampilkan di galeri -->
            @if($berita->images->count() > 1)
            <div class="mt-5">
                <h5 class="fw-bold mb-3">Foto Lainnya</h5>
                <div class="row g-3">
                    @foreach($berita->images->skip(1) as $img)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ asset('storage/' . $img->gambar) }}" target="_blank">
                            <img src="{{ asset('storage/' . $img->gambar) }}"
                                 class="img-fluid rounded shadow"
                                 style="object-fit:cover; height:140px; width:100%;">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ========================= -->
        <!--  SIDEBAR BERITA LAIN      -->
        <!-- ========================= -->
        <div class="col-lg-4">

            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold">
                    Berita Terbaru
                </div>

                <div class="list-group list-group-flush">

                    @foreach(App\Models\Berita::latest()->take(5)->get() as $b)

                    @php
                    $thumb = $b->images->first();
                    @endphp

                    <a href="{{ route('berita.detail', $b->slug) }}"
                       class="list-group-item list-group-item-action d-flex">

                        <img src="{{ $thumb ? asset('storage/' . $thumb->gambar) : asset('images/default.jpg') }}"
                             width="60" height="60"
                             class="rounded me-2"
                             style="object-fit:cover;">

                        <div>
                            <small class="text-muted d-block">{{ $b->created_at->format('d M Y') }}</small>
                            <p class="mb-0 small">{{ $b->judul }}</p>
                        </div>

                    </a>

                    @endforeach

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
