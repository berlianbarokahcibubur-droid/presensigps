@extends('layouts.presensi')

@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">E-Presensi</div>
    <div class="right"></div>
</div>

<style>
.webcam-capture,
.webcam-capture video{
    width: 100% !important;
    height: auto !important;
    border-radius: 15px;
}

#map { 
    height: 300px; 
}
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection

@section('content')

<div class="row" style="margin-top: 70px">
    <div class="col">
        <input type="hidden" id="lokasi">
        <div class="webcam-capture"></div>
    </div>
</div>
<div class="row mt-2">
    <div class="col">
@if ($cek > 0)
    <button id="takeabsen" class="btn btn-danger btn-block">
        <ion-icon name="camera-outline"></ion-icon> Absen Pulang
    </button>
@else
    <button id="takeabsen" class="btn btn-primary btn-block">
        <ion-icon name="camera-outline"></ion-icon> Absen Masuk
    </button>
@endif
    </div>
</div>

<div class="row mt-2">
    <div class="col">
        <div id="map"></div>
    </div>
</div>

@endsection


@push('myscript')
<script>
let image = "";

/* =========================
   WEB CAM SETUP
========================= */
Webcam.set({
    width: 640,
    height: 480,
    image_format: 'jpeg',
    jpeg_quality: 80
});

Webcam.attach('.webcam-capture');


/* =========================
   GEOLOCATION + MAP
========================= */
var lokasi = document.getElementById('lokasi');

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
}

function successCallback(position) {

    let lat = position.coords.latitude;
    let long = position.coords.longitude;

    lokasi.value = lat + "," + long;

    var map = L.map('map').setView([lat, long], 16);
    var lokasi_kantor = "{{ $lok_kantor->lokasi_kantor }}";
    var lok = lokasi_kantor.split(",");
    var lat_kantor = lok[0];
    var long_kantor = lok[1];
    var radius = "{{ $lok_kantor->radius }}";

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    L.marker([lat, long]).addTo(map);

    // radius visual (opsional)
    L.circle([lat_kantor, long_kantor], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius
    }).addTo(map);
}

function errorCallback(err){
    console.log(err);

    Swal.fire({
        icon: 'error',
        title: 'GPS Error',
        text: 'GPS tidak aktif atau tidak diizinkan'
    });
}


/* =========================
   BUTTON ABSEN
========================= */
$("#takeabsen").click(function(){

    let lokasiVal = $("#lokasi").val();

    if (!lokasiVal) {
        Swal.fire({
            icon: 'error',
            title: 'Lokasi belum terdeteksi',
            text: 'Tunggu GPS aktif terlebih dahulu'
        });
        return;
    }

    Webcam.snap(function(uri){

        $.ajax({
            type: 'POST',
            url: '/presensi/store',
            data: {
                _token: "{{ csrf_token() }}",
                image: uri,
                lokasi: lokasiVal
            },

            success: function(respond) {

                console.log("RESPOND:", respond);

                respond = respond.trim();

                if (respond == 'in') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Selamat Bekerja'
                    });

                } else if (respond == 'out') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Terima kasih, Hati-hati Dijalan!'
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: respond
                    });

                }

                setTimeout(function(){
                    location.href = '/dashboard';
                }, 2000);
            },

            error: function(xhr){

                console.log(xhr.responseText);

                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: 'Terjadi kesalahan sistem'
                });
            }
        });

    });

});
</script>
@endpush