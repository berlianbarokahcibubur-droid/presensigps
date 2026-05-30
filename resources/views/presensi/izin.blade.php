@extends('layouts.presensi')

@section('header')

<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>

    <div class="pageTitle">Data Izin / Sakit</div>

    <div class="right"></div>
</div>

@endsection


@section('content')

<style>
    body{
        background: #f4f6f9;
    }

    .izin-container{
        margin-top: 75px;
        padding: 12px;
    }

    .izin-card{
        background: #fff;
        border-radius: 18px;
        padding: 15px;
        margin-bottom: 14px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        border-left: 5px solid #0d6efd;
        transition: 0.2s;
    }

    .izin-card:hover{
        transform: translateY(-2px);
    }

    .izin-header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .izin-date{
        font-size: 15px;
        font-weight: 700;
        color: #111;
    }

    .izin-subtitle{
        font-size: 13px;
        color: #666;
        margin-top: 10px;
        line-height: 1.5;
    }

    .badge-group{
        display: flex;
        flex-direction: column;
        gap: 6px;
        align-items: end;
    }

    .status-badge{
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Badge Jenis */
    .badge-izin{
        background: #e7f1ff;
        color: #0d6efd;
    }

    .badge-sakit{
        background: #ffe7e7;
        color: #dc3545;
    }

    /* Badge Approval */
    .badge-waiting{
        background: #fff4d6;
        color: #ff9800;
    }

    .badge-approved{
        background: #e7ffe7;
        color: #28a745;
    }

    .badge-decline{
        background: #ffe5e5;
        color: #dc3545;
    }

    .fab-button .fab{
        background: #0d6efd;
        box-shadow: 0 5px 15px rgba(13,110,253,0.4);
    }

    .alert{
        border-radius: 12px;
        font-size: 13px;
    }

    .empty-data{
        text-align: center;
        margin-top: 120px;
        color: #999;
    }

    .empty-data ion-icon{
        font-size: 70px;
        margin-bottom: 10px;
    }
</style>


<div class="izin-container">

    {{-- Alert Success --}}
    @if(Session::get('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    {{-- Alert Error --}}
    @if(Session::get('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
    @endif


    {{-- Jika Tidak Ada Data --}}
    @if($dataizin->isEmpty())

    <div class="empty-data">
        <ion-icon name="document-text-outline"></ion-icon>
        <h5>Belum Ada Data</h5>
        <p>Data izin / sakit belum tersedia</p>
    </div>

    @else

    {{-- Data Izin --}}
    @foreach ($dataizin as $d)

    <div class="izin-card">

        <div style="width:100%;">

            <div class="izin-header">

                {{-- Tanggal --}}
                <div class="izin-date">
                    {{ date('d-m-Y', strtotime($d->tgl_izin)) }}
                </div>

                {{-- Badge --}}
                <div class="badge-group">

                    {{-- Badge Jenis --}}
                    <div class="status-badge {{ $d->status == 's' ? 'badge-sakit' : 'badge-izin' }}">

                        @if($d->status == 's')
                            🏥 Sakit
                        @else
                            📄 Izin
                        @endif

                    </div>

                    {{-- Badge Approval --}}
                    <div class="status-badge
                        @if($d->status_approved == 0)
                            badge-waiting
                        @elseif($d->status_approved == 1)
                            badge-approved
                        @else
                            badge-decline
                        @endif
                    ">

                        @if($d->status_approved == 0)
                            ⏳ Waiting
                        @elseif($d->status_approved == 1)
                            ✅ Approved
                        @else
                            ❌ Declined
                        @endif

                    </div>

                </div>

            </div>

            {{-- Keterangan --}}
            <div class="izin-subtitle">

                @if(!empty($d->keterangan))
                    {{ $d->keterangan }}
                @else
                    Tidak ada keterangan
                @endif

            </div>

        </div>

    </div>

    @endforeach

    @endif

</div>


{{-- Floating Button --}}
<div class="fab-button bottom-right" style="margin-bottom:70px">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>

@endsection