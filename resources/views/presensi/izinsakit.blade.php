@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Data Izin / Sakit
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -12" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2l0 -2" /></svg>
                                </span>
                                <input type="text" value="{{ Request ('dari') }}" id="dari" class="form-control" name="dari" placeholder="Dari">
                              </div>
                        </div>
                        <div class="col-6">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -12" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2l0 -2" /></svg>
                                </span>
                                <input type="text" value="{{ Request ('sampai') }}" id="sampai" class="form-control" name="sampai" placeholder="Sampai">
                              </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-barcode"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 11h1v2h-1l0 -2" /><path d="M10 11l0 2" /><path d="M14 11h1v2h-1l0 -2" /><path d="M19 11l0 2" /></svg>
                                </span>
                                <input type="text" value="{{ Request ('nik') }}" id="nik" class="form-control" name="nik" placeholder="Nik">
                              </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M5 7a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                </span>
                                <input type="text" value="{{ Request ('nama_lengkap') }}" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                              </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="0" {{ Request('status_approved') === '0' ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ Request('status_approved') == 1 ? 'selected' : '' }}>Disetujui</option>
                                    <option value="2" {{ Request('status_approved') == 2 ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                Cari Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>NIK</th>
                                        <th>Nama Karyawan</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
                                        <th>Status Approve</th>
                                        <th width="180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($izinsakit as $d)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ date('d-m-Y', strtotime($d->tgl_izin)) }}
                                        </td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->nama_lengkap }}</td>
                                        <td>{{ $d->jabatan }}</td>
                                        <td>
                                            @if ($d->status == "i")
                                                <span class="badge bg-warning">
                                                    Izin
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    Sakit
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $d->keterangan }}</td>
                                        <td>
                                            @if ($d->status_approved == 1)
                                                <span class="badge bg-success">
                                                    Disetujui
                                                </span>
                                            @elseif($d->status_approved == 2)
                                                <span class="badge bg-danger">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($d->status_approved == 0)
                                                <a href="#"
                                                   class="btn btn-sm btn-primary approve"
                                                   id_izin="{{ $d->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         width="24"
                                                         height="24"
                                                         viewBox="0 0 24 24"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         stroke-width="2"
                                                         stroke-linecap="round"
                                                         stroke-linejoin="round"
                                                         class="icon icon-tabler icon-tabler-check">
                                                        <path stroke="none"
                                                              d="M0 0h24v24H0z"
                                                              fill="none"/>
                                                        <path d="M5 12l5 5l10 -10" />
                                                    </svg>
                                                    Approve
                                                </a>
                                            @else
                                                <form action="/presensi/{{ $d->id }}/batalkanizinsakit"
                                                      method="POST"
                                                      style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin membatalkan approval?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             width="24"
                                                             height="24"
                                                             viewBox="0 0 24 24"
                                                             fill="none"
                                                             stroke="currentColor"
                                                             stroke-width="2"
                                                             stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="icon icon-tabler icon-tabler-x">
                                                            <path stroke="none"
                                                                  d="M0 0h24v24H0z"
                                                                  fill="none"/>
                                                            <path d="M18 6l-12 12" />
                                                            <path d="M6 6l12 12" />
                                                        </svg>
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL APPROVE -->
<div class="modal modal-blur fade"
     id="modalizinsakit"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Approval Izin / Sakit
                </h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>
            <form action="/presensi/approveizinsakit"
                  method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden"
                           name="id_izin"
                           id="id_izin">
                    <div class="mb-3">
                        <label class="form-label">
                            Status Approval
                        </label>
                        <select name="status_approved"
                                id="status_approved"
                                class="form-select">
                            <option value="1">
                                Disetujui
                            </option>
                            <option value="2">
                                Ditolak
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('myscript')

<script>
$(function(){
    $(".approve").click(function(e){
        e.preventDefault();
        var id_izin = $(this).attr("id_izin");
        $("#id_izin").val(id_izin);
        $("#modalizinsakit").modal("show");
    });

     $("#dari, #sampai").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
});

</script>

@endpush