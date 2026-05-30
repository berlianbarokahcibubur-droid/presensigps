@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Master
                </div>
                <h2 class="page-title">
                  Data Karyawan
                </h2>
              </div>
              <!-- Page title actions -->
            </div>
          </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">
                                            {{ Session::get('warning') }}                                              
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary" id="btnTambahkaryawan">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <form action="/karyawan" method="GET">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" 
                                            placeholder="Nama Karyawan" value="{{ Request('nama_karyawan') }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select name="kode_dept" id="kode_dept" class="form-select">
                                                <option value="">Departemen</option>
                                                @foreach ($departemen as $d )
                                                    <option {{ request('kode_dept') == $d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-search"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" /><path d="M15 18a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M20.2 20.2l1.8 1.8" /></svg>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nik</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>No. HP</th>
                                <th>Foto</th>
                                <th>Departemen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <body>
                            @foreach ($karyawan as $d )
                            <tr>
                                <td>{{ $loop->iteration + $karyawan->firstItem()-1 }}</td>
                                <td>{{ $d->nik }}</td>
                                <td>{{ $d->nama_lengkap}}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->no_hp }}</td>
                                <td>
                                    <img src="{{ asset('assets/img/no-photo.png') }}"
                                    width="40"
                                    height="40"
                                    class="rounded-circle me-2">
                                </td>
                                <td>{{ $d->nama_dept }}</td>
                                <td>
    <div class="d-flex gap-1">

        <!-- Tombol Edit -->
        <a href="#"
           class="edit btn btn-info btn-sm"
           nik="{{ $d->nik }}">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="16"
                 height="16"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path stroke="none"
                      d="M0 0h24v24H0z"
                      fill="none"/>

                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415"/>
            </svg>

        </a>

        <!-- Tombol Delete -->
        <form action="/karyawan/{{ $d->nik }}/delete" method="POST"
              style="margin-left:5px">

            @csrf
            

            <a class="btn btn-danger btn-sm delete-confirm">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="16"
                     height="16"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke="none"
                          d="M0 0h24v24H0z"
                          fill="none"/>

                    <path d="M6 7h12"/>
                    <path d="M9 7v-2h6v2"/>
                    <path d="M10 11v6"/>
                    <path d="M14 11v6"/>
                </svg>

</a>

        </form>

    </div>
</td>
                            </tr>
                            @endforeach
                        </body>
                    </table>
                    {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modalinputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/karyawan/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-object-scan"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 10a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-4" /><path d="M3 7v-2a2 2 0 0 1 2 -2h2" /><path d="M3 17v2a2 2 0 0 0 2 2h2" /><path d="M17 3h2a2 2 0 0 1 2 2v2" /><path d="M17 21h2a2 2 0 0 0 2 -2v-2" /></svg>
                                </span>
                                <input type="text" value="" id="nik" class="form-control" name="nik" placeholder="Nik">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                </span>
                                <input type="text" value="" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-heart"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h.5" /><path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296" /></svg>
                                </span>
                                <input type="text" value="" id="jabatan" class="form-control" name="jabatan" placeholder="Jabatan">
                              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                                </span>
                                <input type="text" value="" id="no_hp" class="form-control" name="no_hp" placeholder="No. HP">
                              </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                            <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <select name="kode_dept" id="kode_dept" class="form-select">
                                                <option value="">Departemen</option>
                                                @foreach ($departemen as $d )
                                                    <option {{ request('kode_dept') == $d->kode_dept ? 'selected' : '' }} value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                                @endforeach
                                            </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
{{-- modal edit --}}
    <div class="modal modal-blur fade" id="modaleditkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">
            
          </div>
        </div>
      </div>
    </div>
@endsection

@push('myscript')
<script>
    $(function(){
        $("#btnTambahkaryawan").click(function(){
            $("#modalinputkaryawan").modal("show");
        });

        $(".edit").click(function(){
            var nik = $(this).attr('nik');
            $.ajax({
                type:'POST',
                url:'/karyawan/edit',
                cache:false,
                data:{
                    _token:"{{ csrf_token() }}",
                    nik:nik 
                    },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $("#modaleditkaryawan").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
  title: "Apakah Data Yakin Akan Dihapus?",
  showCancelButton: true,
  confirmButtonText: "Delete",
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    form.submit();
Swal.fire("Deleted", "", "success");
  }
});
        });

        $("#frmKaryawan").submit(function(){
            var nik = $("#nik").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var jabatan = $("#jabatan").val();
            var no_hp = $("#no_hp").val();
            var kode_dept = $("#frmKaryawan").find("#kode_dept").val();
            if(nik==""){
                Swal.fire({
                title: 'warning!',
                text: 'Nik Harus Diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#nik").focus();
                });
                
                return false;
            }else if(nama_lengkap==""){
                Swal.fire({
                title: 'warning!',
                text: 'Nama Harus Diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#nama_lengkap").focus();
                });
                
                return false;
            }else if(jabatan==""){
                Swal.fire({
                title: 'warning!',
                text: 'Jabatan Harus Diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#jabatan").focus();
                });
                
                return false;
            }else if(no_hp==""){
                Swal.fire({
                title: 'warning!',
                text: 'No. HP Harus Diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#no_hp").focus();
                });
                
                return false;
            }else if(kode_dept==""){
                Swal.fire({
                title: 'warning!',
                text: 'Departemen Harus Diisi',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result)=>{
                    $("#kode_dept").focus();
                });
                
                return false;
            }
        });
    });
</script>
@endpush