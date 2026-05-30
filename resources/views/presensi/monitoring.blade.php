@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Monitoring Presensi
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <!-- FILTER -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24"
                                     height="24"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icon-tabler-calendar">
                                    <path stroke="none"
                                          d="M0 0h24v24H0z"
                                          fill="none"/>
                                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12"/>
                                    <path d="M16 3v4"/>
                                    <path d="M8 3v4"/>
                                    <path d="M4 11h16"/>
                                </svg>
                            </span>
                            <input type="text"
                                   id="tanggal"
                                   value="{{ date('Y-m-d') }}"
                                   class="form-control"
                                   placeholder="Tanggal Presensi"
                                   autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- TABLE -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Jam Masuk</th>
                                    <th>Foto</th>
                                    <th>Jam Pulang</th>
                                    <th>Foto</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="loadpresensi">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- CARD MAP -->
        <div class="row mt-3"
             id="cardmap"
             style="display:none;">
            <div class="col-12">
                <div class="card">
                    <!-- HEADER -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            Lokasi Presensi User
                        </h3>
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                id="closemap">
                            Tutup
                        </button>
                    </div>
                    <!-- BODY -->
                    <div class="card-body" id="loadmap">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('myscript')
<script>
$(function () {
    // =========================
    // DATE PICKER
    // =========================
    $("#tanggal").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    }).datepicker('update', new Date());

    // =========================
    // LOAD PRESENSI
    // =========================
    function loadpresensi(){
        var tanggal = $("#tanggal").val();
        $.ajax({
            type:'POST',
            url:'/getpresensi',
            data:{
                _token:"{{ csrf_token() }}",
                tanggal:tanggal
            },
            cache:false,
            success:function(respond){
                $("#loadpresensi").html(respond);
            },
            error:function(xhr){
                console.log(xhr.responseText);
                alert("Data presensi gagal dimuat");
            }
        });
    }
    // LOAD PERTAMA
    loadpresensi();

    // GANTI TANGGAL
    $("#tanggal").change(function(){
        loadpresensi();
    });

    // =========================
    // TAMPILKAN MAP
    // =========================
    $(document).on('click', '.tampilkanpeta', function(e){
        e.preventDefault();
        var id = $(this).attr("id");
        console.log("ID :", id);
        $.ajax({
            type:'POST',
            url:'/tampilkanpeta',
            data:{
                _token:"{{ csrf_token() }}",
                id:id
            },
            cache:false,
            beforeSend:function(){
                $("#loadmap").html(`
                    <div class="text-center p-3">
                        Loading Map...
                    </div>
                `);
                $("#cardmap").show();
            },
            success:function(respond){
                console.log(respond);
                // LOAD MAP
                $("#loadmap").html(respond);
                // TAMPILKAN CARD
                $("#cardmap").show();
                // SCROLL KE MAP
                $('html, body').animate({
                    scrollTop: $("#cardmap").offset().top
                }, 500);
            },
            error:function(xhr){
                console.log(xhr.responseText);
                $("#loadmap").html(`
                    <div class="alert alert-danger">
                        Map gagal dimuat
                    </div>
                `);
                $("#cardmap").show();
            }
        });
    });
    // =========================
    // CLOSE MAP
    // =========================
    $(document).on('click', '#closemap', function(){
        $("#cardmap").hide();
    });
});
</script>
@endpush