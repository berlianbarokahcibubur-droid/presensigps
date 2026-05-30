@if($histori->count() > 0)

<ul class="listview image-listview">

@foreach ($histori as $d)
<li>
    <div class="d-flex align-items-center p-2">

        @php
            $path = Storage::url('uploads/absensi/' . $d->foto_in);
        @endphp

        {{-- Foto --}}
        <div class="me-2">
            @if($d->foto_in != '')
                <img src="{{ url($path) }}" class="imaged w48 rounded-circle">
            @else
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" class="imaged w48 rounded-circle">
            @endif
        </div>

        {{-- Tanggal --}}
        <div style="flex:1;">
            <div style="font-size:14px; font-weight:600;">
                {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}
            </div>
        </div>

        {{-- Jam kanan --}}
        <div>
            <span class="badge {{ $d->jam_in < '09:00' ? 'bg-success' : 'bg-danger' }}">
                {{ $d->jam_in }}
            </span>
            <span   class="badge bg-primary">
                {{ $d->jam_out }}
            </span>
        </div>

    </div>
</li>
@endforeach

</ul>

@else

<div class="alert alert-danger text-center mt-2">
    Data histori tidak ditemukan
</div>

@endif