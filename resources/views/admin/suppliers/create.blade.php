@extends('admin.app')

@section('title','Tambah Supplier')

{{-- ========================= --}}
{{-- CSS KHUSUS HALAMAN --}}
{{-- ========================= --}}
@section('head')

{{-- Leaflet CSS --}}
<link rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

{{-- Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
      rel="stylesheet" />

<style>
    #mapid {
        height: 75vh !important;
        width: 100%;
    }
</style>

@endsection


@section('content')

<div class="row">

    {{-- ================================================= --}}
    {{-- FORM INPUT --}}
    {{-- ================================================= --}}
    <div class="col-md-6">
        <div class="card">

            <div class="card-header bg-success text-white">
                Tambah Supplier
            </div>

            <div class="card-body">
                <form action="{{ route('admin.suppliers.store') }}" method="POST">
                    @csrf

                    {{-- Nama Supplier --}}
                    <div class="form-group mb-3">
                        <label>Nama Supplier</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- Jenis Supplier --}}
                    <div class="form-group mb-3">
                        <label>Jenis Supplier</label>
                        <select name="supplier_type_id" class="form-control select2" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($types as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group mb-3">
                        <label>Alamat</label>
                        <textarea name="address" rows="2" class="form-control"></textarea>
                    </div>

                    {{-- Provinsi --}}
                    <div class="form-group mb-3">
                        <label>Provinsi</label>
                        <select name="province_id" id="province" class="form-control select2" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach ($provinces as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kabupaten --}}
                    <div class="form-group mb-3">
                        <label>Kabupaten / Kota</label>
                        <select name="regency_id" id="regency" class="form-control select2" required>
                            <option value="">-- Pilih Kabupaten/Kota --</option>
                        </select>
                    </div>

                    {{-- Kecamatan --}}
                    <div class="form-group mb-3">
                        <label>Kecamatan</label>
                        <select name="district_id" id="district" class="form-control select2" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    {{-- Desa --}}
                    <div class="form-group mb-3">
                        <label>Desa</label>
                        <select name="village_id" id="village" class="form-control select2" required>
                            <option value="">-- Pilih Desa --</option>
                        </select>
                    </div>

                    {{-- Koordinat --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <input type="text" id="latitude" name="latitude" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Longitude</label>
                            <input type="text" id="longitude" name="longitude" class="form-control">
                        </div>
                    </div>

                    <button class="btn btn-success mt-3">Simpan</button>

                    <a href="{{ route('admin.suppliers.index') }}"
                       class="btn btn-secondary mt-3 ml-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                </form>
            </div>

        </div>
    </div>

    {{-- ================================================= --}}
    {{-- PETA --}}
    {{-- ================================================= --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                Lokasi Peta
            </div>
            <div class="card-body p-0">
                <div id="mapid"></div>
            </div>
        </div>
    </div>

</div>

@endsection


{{-- ================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================================= --}}
@push('scripts')

{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Select2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.select2').select2();

    // Default map center Padang
    var mapCenter = [-0.9471, 100.4172];

    var map = L.map('mapid').setView(mapCenter, 13);

    // ==========================
    // 🗺️ TILE LAYERS
    // ==========================

    // Google Streets
    var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    // Google Hybrid
    var googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    // Google Satellite
    var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    // Google Terrain
    var googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    // OpenStreet Map
    var openStreet = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    });

    // 🔥 Set default layer
    googleHybrid.addTo(map);

    // ==========================
    // 🧭 LAYER CONTROL
    // ==========================
    var baseLayers = {
        "Google Hybrid": googleHybrid,
        "Google Streets": googleStreets,
        "Google Satellite": googleSat,
        "Google Terrain": googleTerrain,
        "OpenStreet Map": openStreet
    };

    L.control.layers(baseLayers).addTo(map);

    // ==========================
    // 📍 MARKER
    // ==========================
    var marker = L.marker(mapCenter).addTo(map);

    function updateMarker(lat, lng) {
        marker.setLatLng([lat, lng])
            .bindPopup("Lokasi: " + lat + ", " + lng)
            .openPopup();
    }

    // Klik peta → ambil koordinat
    map.on('click', function(e) {
        let lat = e.latlng.lat.toFixed(6);
        let lng = e.latlng.lng.toFixed(6);

        $('#latitude').val(lat);
        $('#longitude').val(lng);

        updateMarker(lat, lng);
    });

    // Input manual → update marker
    $('#latitude, #longitude').on('input', function() {
        let lat = $('#latitude').val();
        let lng = $('#longitude').val();
        updateMarker(lat, lng);
    });
</script>


{{-- ================================================= --}}
{{-- AJAX 4 DROPDOWN WILAYAH --}}
{{-- ================================================= --}}
<script>
    // Load Kabupaten berdasarkan Provinsi
    $('#province').change(function () {
        let id = $(this).val();
        $('#regency').empty().append('<option>Memuat...</option>');
        $('#district').empty().append('<option>-- Pilih Kecamatan --</option>');
        $('#village').empty().append('<option>-- Pilih Desa --</option>');

        $.get('/get-regencies/' + id, function (res) {
            $('#regency').empty().append('<option value="">-- Pilih Kabupaten/Kota --</option>');
            $.each(res, function(i, item) {
                $('#regency').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    });

    // Load Kecamatan berdasarkan Kabupaten
    $('#regency').change(function () {
        let id = $(this).val();
        $('#district').empty().append('<option>Memuat...</option>');
        $('#village').empty().append('<option>-- Pilih Desa --</option>');

        $.get('/get-districts/' + id, function (res) {
            $('#district').empty().append('<option>-- Pilih Kecamatan --</option>');
            $.each(res, function(i, item) {
                $('#district').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    });

    // Load Desa berdasarkan Kecamatan
    $('#district').change(function () {
        let id = $(this).val();
        console.log("Fetching villages for district:", id);
        $('#village').empty().append('<option>Memuat...</option>');

        $.get('/get-villages/' + id, function (res) {
            $('#village').empty().append('<option>-- Pilih Desa --</option>');
            $.each(res, function(i, item) {
                $('#village').append(`<option value="${item.id}">${item.name}</option>`);
            });
        });
    });
</script>

@endpush
