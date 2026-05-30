@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<style>

    /* =========================
       DATEPICKER
    ========================= */

    .modal.datepicker-modal {
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 320px !important;
        max-width: 90% !important;
        height: auto !important;
        max-height: 520px !important;
        overflow: hidden !important;
        border-radius: 12px !important;
    }

    .datepicker-modal .modal-content {
        padding: 0 !important;
        height: auto !important;
        min-height: auto !important;
        max-height: unset !important;
        overflow: hidden !important;
    }

    .datepicker-container {
        height: auto !important;
        min-height: auto !important;
    }

    .datepicker-calendar-container {
        height: auto !important;
    }

    .datepicker-footer {
        padding: 10px 15px !important;
        background: #fff !important;
    }

    /* =========================
       CUSTOM COLOR
    ========================= */

    .datepicker-date-display {
        background-color: #0d6efd !important;
    }

    .datepicker-table td.is-selected {
        background-color: #0d6efd !important;
    }

</style>


<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
        <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
<div class="pageTitle">Form Izin</div>
<div class="right"></div>
</div>
@endsection
@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form method="POST" action="/presensi/storeizin" id="frmizin">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="text" id="tgl_izin" name="tgl_izin" class="datepicker" placeholder="Tanggal">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="formgroup">
                        <select name="status" id="status" class="form-control">
                            <option value="">Izin / Sakit</option>
                            <option value="i">Izin</option>
                            <option value="s">Sakit</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('myscript')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // INIT DATEPICKER
    var elems = document.querySelectorAll('.datepicker');

    M.Datepicker.init(elems, {
        format: 'yyyy-mm-dd',
        autoClose: true
    });

    $("#tgl_izin").change(function(e){
        var tgl_izin = $(this).val();
        $.ajax({
            type: 'POST',
            url: '/presensi/cekpengajuanizin',
            data:{
                _token: "{{ csrf_token() }}",
                tgl_izin: tgl_izin
            },
            cache: false,
            success: function (respond){
                if(respond==1){
                    Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Tidak Bisa Melakukan Pengajuan Izin/Sakit Kembali Dihari Yang Sama!'
                     }).then((result)=>{
                        $("#tgl_izin").val("");
                     });
                }
            }
        });
    });

    // VALIDASI FORM
    $("#frmizin").submit(function (e) {

        var tgl_izin  = $("#tgl_izin").val();
        var status    = $("#status").val();
        var keterangan = $("#keterangan").val();

        if (tgl_izin == "") {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Tanggal harus diisi!'
            });

            return false;
        }

        if (status == "") {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Status harus dipilih!'
            });

            return false;
        }

        if (keterangan == "") {
            e.preventDefault();

            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Keterangan harus diisi!'
            });

            return false;
        }

    });

});
</script>
@endpush