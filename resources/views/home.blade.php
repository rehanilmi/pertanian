@extends('layouts.app')

@section('title', 'Beranda - Dinas Pertanian Kota Padang')

@section('content')
<style>
/* SMOOTH SCROLL */
html { scroll-behavior: smooth; }
/* PROFIL KADIS */
.profil-img {
    width: 130px; height: 130px; object-fit: cover;
    border-radius: 50%; border: 4px solid #1b5e20;
    box-shadow: 0 0 8px rgba(0,0,0,0.18);
}
</style>
<!-- === BANNER / SLIDER === -->
<div id="bannerSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/banner 1.jpg') }}" class="d-block w-100" style="max-height: 480px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/banner 2.jpg') }}" class="d-block w-100" style="max-height: 480px; object-fit: cover;">
        </div>
    </div>
</div>

<!-- === LAYANAN === -->
<section class="py-5" style="background-color:#1b5e20;">
    <div class="container text-center text-white">
        <h3 class="fw-bold mb-4">Layanan Dinas Pertanian Kota Padang</h3>
        <div class="row justify-content-center g-3">

            @php
            $layanan = [
            ['icon'=>'🌿','title'=>'Portal PPID'],
            ['icon'=>'💬','title'=>'Konsultasi Pertanian Online'],
            ['icon'=>'☎️','title'=>'Kontak Pengaduan'],
            ['icon'=>'📋','title'=>'Perizinan Pertanian'],
            ['icon'=>'🌾','title'=>'Perbenihan'],
            ['icon'=>'👨‍🌾','title'=>'Pengembangan SDM'],
            ['icon'=>'🧾','title'=>'Data Subsidi Pupuk'],
            ['icon'=>'🐄','title'=>'Peternakan & Kesehatan Hewan'],
            ];
            @endphp

            @foreach($layanan as $item)
            <div class="col-6 col-md-3 col-lg-2">
                <div class="card border-0 shadow-sm text-dark h-100">
                    <div class="card-body text-center">
                        <div class="fs-2 mb-2">{{ $item['icon'] }}</div>
                        <p class="fw-semibold small">{{ $item['title'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- === KABAR TERKINI === -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 align-items-start">

            <!-- Kiri -->
            <div class="col-lg-8">
                <h3 class="text-success fw-bold mb-3">Kabar Terkini Dinas Pertanian</h3>

                @foreach($beritaTerbaru as $b)

                @php
                $thumb = $b->images->first();
                @endphp

                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="row g-0">
                        <div class="col-md-6">

                            <img src="{{ $thumb ? asset('storage/'.$thumb->gambar) : asset('images/default.jpg') }}"
                                 class="img-fluid h-100"
                                 style="object-fit:cover;">

                        </div>
                        <div class="col-md-6 p-3">
                            <small class="text-muted">{{ $b->created_at->format('d M Y') }}</small>
                            <h5 class="fw-bold">{{ $b->judul }}</h5>
                            <p class="small">{!! Str::limit(strip_tags($b->isi), 200) !!}</p>
                            <a href="{{ route('berita.detail', $b->slug) }}" class="btn btn-success btn-sm">
                                Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>

            <!-- Kanan: Counter + Arsip -->
            <div class="col-lg-4">

                <!-- Counter -->
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-graph-up"></i> Counter</h6>
                        <p class="mb-1">Hari Ini: <strong>3,376</strong></p>
                        <p class="mb-1">Bulan Ini: <strong>408,895</strong></p>
                        <p class="mb-1">Tahun Ini: <strong>1,560,814</strong></p>
                    </div>
                </div>

                <!-- Arsip -->
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white fw-semibold">
                        Arsip Berita
                    </div>

                    <div class="list-group list-group-flush">

                        @foreach($arsipBerita as $arsip)

                        @php
                        $thumb = $arsip->images->first();
                        @endphp

                        <a href="{{ route('berita.detail', $arsip->slug) }}"
                           class="list-group-item list-group-item-action d-flex">

                            <img src="{{ $thumb ? asset('storage/'.$thumb->gambar) : asset('images/default.jpg') }}"
                                 width="60" height="60"
                                 class="me-2 rounded"
                                 style="object-fit:cover;">

                            <div>
                                <small class="text-muted d-block">
                                    {{ $arsip->created_at->format('d M Y') }}
                                </small>
                                <p class="mb-0 small">{{ $arsip->judul }}</p>
                            </div>

                        </a>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- === PENGUMUMAN + PROFIL + STATISTIK === -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">

            <!-- PENGUMUMAN -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-success text-white fw-semibold">Pengumuman</div>
                    <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                        @forelse($pengumuman as $p)
                        <div class="mb-3">
                            <strong>{{ $p->judul }}</strong><br>
                            <small class="text-muted">{{ $p->created_at->format('d M Y') }}</small>
                        </div>
                        @empty
                        <p class="text-muted small">Belum ada pengumuman.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- PROFIL -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white fw-semibold">Profil Kepala Dinas</div>
                    <div class="card-body text-center">

                        <img src="{{ asset('images/kepala_dinas.jpg') }}"
                             class="profil-img mb-3">

                        <h6 class="fw-bold">{{ $kepalaDinas->nama ?? 'Nama Kepala Dinas' }}</h6>
                        <small class="text-muted">{{ $kepalaDinas->jabatan ?? 'Kepala Dinas Pertanian' }}</small>

                        <p class="mt-2 small">{{ $kepalaDinas->deskripsi ?? 'Profil singkat kepala dinas akan tampil di sini.' }}</p>
                    </div>
                </div>
            </div>

            <!-- STATISTIK -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-warning fw-semibold">Statistik Pengunjung Website</div>
                    <div class="card-body">
                        <p class="mb-1">Hari Ini: <strong>{{ $stat->today ?? 0 }}</strong></p>
                        <p class="mb-1">Bulan Ini: <strong>{{ $stat->month ?? 0 }}</strong></p>
                        <p class="mb-1">Total Pengunjung: <strong>{{ $stat->total ?? 0 }}</strong></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- === SEKILAS DATA === -->
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">Sekilas Data Pertanian</h2>
        <div class="row g-4">
            @php
            $data = [
            ['angka'=>'1.230','label'=>'Petani Binaan'],
            ['angka'=>'3.250 ha','label'=>'Luas Tanam'],
            ['angka'=>'7.800 ton','label'=>'Produksi'],
            ['angka'=>'95%','label'=>'Bantuan Tersalurkan'],
            ];
            @endphp

            @foreach($data as $d)
            <div class="col-md-3">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="fw-bold text-success">{{ $d['angka'] }}</h4>
                        <p class="mb-0">{{ $d['label'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

<!-- === PROGRAM UNGGULAN === -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Program Unggulan</h2>

        <div class="row text-center">
            <div class="col-md-4">
                <div class="card p-4 shadow-sm border-0 h-100">
                    <h5 class="fw-bold text-success">🌿 Urban Farming</h5>
                    <p>Pengembangan pertanian perkotaan yang produktif dan ramah lingkungan.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 shadow-sm border-0 h-100">
                    <h5 class="fw-bold text-success">🌾 Ketahanan Pangan</h5>
                    <p>Program untuk menjaga ketersediaan pangan berkelanjutan di seluruh wilayah.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4 shadow-sm border-0 h-100">
                    <h5 class="fw-bold text-success">💻 Digitalisasi LTT</h5>
                    <p>Implementasi sistem data tanam terintegrasi secara digital.</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
