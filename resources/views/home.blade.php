@extends('layouts.app')

@section('title', 'Beranda - Dinas Pertanian Kota Padang')

@section('content')

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

<!-- === LAYANAN DINAS PERTANIAN === -->
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

            <!-- Kiri: Berita utama -->
            <div class="col-lg-8">
                <h3 class="text-success fw-bold mb-3">Kabar Terkini Dinas Pertanian</h3>

                @php
                $beritaDummy = [
                [
                'judul' => 'Dinas Pertanian Gelar Penyuluhan Petani di Lubuk Buaya',
                'isi' => 'Dalam rangka meningkatkan produksi pangan, Dinas Pertanian Kota Padang melaksanakan penyuluhan pertanian di daerah Lubuk Buaya dengan melibatkan lebih dari 200 petani.',
                'gambar' => 'berita1.jpg',
                'tanggal' => '28 Oktober 2025'
                ],
                [
                'judul' => 'Program Urban Farming Dorong Kemandirian Pangan Rumah Tangga',
                'isi' => 'Urban farming menjadi salah satu program unggulan yang terus dikembangkan oleh Dinas Pertanian Kota Padang.',
                'gambar' => 'berita2.png',
                'tanggal' => '26 Oktober 2025'
                ]
                ];
                @endphp

                @foreach($beritaDummy as $b)
                <div class="card border-0 shadow-sm overflow-hidden mb-4">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ asset('images/'.$b['gambar']) }}" class="img-fluid h-100" style="object-fit:cover;">
                        </div>
                        <div class="col-md-6 p-3">
                            <small class="text-muted">{{ $b['tanggal'] }}</small>
                            <h5 class="fw-bold">{{ $b['judul'] }}</h5>
                            <p class="small">{{ Str::limit($b['isi'], 200) }}</p>
                            <a href="#" class="btn btn-success btn-sm">Selengkapnya</a>
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

                <!-- Arsip Berita -->
                @php
                $arsipDummy = [
                [
                'judul'=>'Peningkatan Produksi Jagung di Kecamatan Kuranji',
                'tanggal'=>'20 Okt 2025',
                'gambar'=>'berita1.jpg'
                ],
                [
                'judul'=>'Sosialisasi Pupuk Bersubsidi untuk Petani Muda',
                'tanggal'=>'15 Okt 2025',
                'gambar'=>'berita2.png'
                ],
                [
                'judul'=>'Gerakan Tanam Cabai Serentak di 11 Kecamatan Kota Padang',
                'tanggal'=>'10 Okt 2025',
                'gambar'=>'berita1.jpg'
                ],
                [
                'judul'=>'Pelatihan Digitalisasi Data LTT untuk Penyuluh Pertanian',
                'tanggal'=>'5 Okt 2025',
                'gambar'=>'berita2.png'
                ],
                [
                'judul'=>'Kegiatan Panen Raya di Kecamatan Nanggalo Bersama Petani Binaan',
                'tanggal'=>'28 Sep 2025',
                'gambar'=>'berita1.jpg'
                ],
                ];
                @endphp

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white fw-semibold">Arsip Berita</div>
                    <div class="list-group list-group-flush">
                        @foreach($arsipDummy as $arsip)
                        <a href="#" class="list-group-item list-group-item-action d-flex">
                            <img src="{{ asset('images/'.$arsip['gambar']) }}" width="60" height="60" class="me-2 rounded" style="object-fit:cover;">
                            <div>
                                <small class="text-muted d-block">{{ $arsip['tanggal'] }}</small>
                                <p class="mb-0 small">{{ $arsip['judul'] }}</p>
                            </div>
                        </a>
                        @endforeach
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
                    <p>Implementasi sistem data tanam terintegrasi secara digital dan real-time.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- === AGENDA === -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Agenda Kegiatan</h2>
        <ul class="list-group list-group-flush shadow-sm">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>📅 Penyuluhan Padi Sawah</span>
                <span class="badge bg-success">5 Nov 2025</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>📅 Sosialisasi e-Kios</span>
                <span class="badge bg-success">12 Nov 2025</span>
            </li>
        </ul>
    </div>
</section>

@endsection
