@extends('layouts.app')

@section('title', 'Peta Perbenihan Padi')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
    #map {
        width: 100%;
        height: 80vh;
        border-radius: 10px;
    }
</style>

<div class="container py-4">
    <h3 class="mb-3">Peta Lokasi Supplier / Stok Benih</h3>

    <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([-0.9471, 100.4172], 12);

    // =============================
    // GOOGLE MAP LAYERS
    // =============================
    var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    var openStreet = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
    });

    // Default layer
    googleTerrain.addTo(map);

    // =============================
    // AMBIL DATA SUPPLIER DARI LARAVEL
    // =============================
    var suppliers = @json($suppliers);

    var markers = L.featureGroup();

    suppliers.forEach(function(s) {

        // Hitung total stok dari supplier
        let totalStock = 0;
        if (s.stocks && s.stocks.length > 0) {
            s.stocks.forEach(st => {
                totalStock += parseInt(st.quantity);
            });
        }

        // Tentukan warna berdasarkan total stok
        let color = "#28a745"; // default hijau
        if (totalStock < 100) {
            color = "#e74c3c"; // merah
        } else if (totalStock < 200) {
            color = "#f1c40f"; // kuning
        }

        // ------ Build Tabel Stok ------
        let stokHtml = "";
        if (s.stocks && s.stocks.length > 0) {
            stokHtml += `<table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Varietas</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>`;
            s.stocks.forEach(st => {
                stokHtml += `
                <tr>
                    <td>${st.variety ? st.variety.name : '-'}</td>
                    <td>${st.quantity} ${st.unit}</td>
                </tr>`;
            });
            stokHtml += `</tbody></table>`;
        } else {
            stokHtml = "<i>Tidak ada data stok benih</i>";
        }

        // ------ Marker Circle dengan warna dinamis ------
        let marker = L.circleMarker([s.latitude, s.longitude], {
            radius: 10,
            fillColor: color,
            color: "#333",
            weight: 2,
            opacity: 1,
            fillOpacity: 0.9
        })
            .bindPopup(`
        <b>${s.name}</b><br>
        <small>${s.address ?? '-'}</small><br><br>

        <b>Total Stok:</b> ${totalStock} kg<br>
        <b>Jenis:</b> ${s.type ? s.type.name : '-'}<br>
        <b>Desa:</b> ${s.village ? s.village.name : '-'}<br>
        <b>Kecamatan:</b> ${s.district ? s.district.name : '-'}<br><br>

        <b>Detail Stok:</b><br>
        ${stokHtml}
        <br>
        <a href="https://www.google.com/maps/dir/?api=1&destination=${s.latitude},${s.longitude}"
           target="_blank"
           class="btn btn-sm btn-primary mt-2">
           🚗 Arahkan ke Lokasi
        </a>
    `)
            .addTo(markers);

    });


    markers.addTo(map);

    if (suppliers.length > 0) {
        map.fitBounds(markers.getBounds());
    }

    // =============================
    // LAYER CONTROL
    // =============================
    var baseLayers = {
        "Google Streets": googleStreets,
        "Google Hybrid": googleHybrid,
        "Google Satellite": googleSat,
        "Google Terrain": googleTerrain,
        "OpenStreet Map": openStreet
    };

    L.control.layers(baseLayers).addTo(map);

    L.control.scale().addTo(map);
</script>

@endsection
