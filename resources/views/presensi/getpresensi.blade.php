@php
function selisih($jam_masuk, $jam_keluar)
{
    $j1 = strtotime($jam_masuk);
    $j2 = strtotime($jam_keluar);

    $selisih = $j2 - $j1;

    $jam = floor($selisih / 3600);
    $menit = floor(($selisih % 3600) / 60);
    $detik = $selisih % 60;

    return $jam . ":" . $menit . ":" . $detik;
}
@endphp
@foreach ($presensi as $d )
@php
$foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
$foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
@endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->nama_dept }}</td>
        <td>{{ $d->jam_in }}</td>
        <td>
            <img src="{{ url($foto_in) }}" class="avatar" alt="">
        </td>
        <td>
        {!! $d->jam_out != null 
        ? $d->jam_out 
        : '<span class="badge bg-danger">Belum Absen</span>' !!}
        </td>
        <td>
            @if ($d->jam_out != null)
            <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @else
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hourglass-high"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M6.5 7h11" /><path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1" /><path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1" /></svg>
            @endif
            
        </td>
        <td>

    @php
        $jam_masuk = strtotime($d->jam_in);
        $batas_masuk = strtotime('08:30:00');
    @endphp
    @if ($jam_masuk > $batas_masuk)
        @php
            $jamterlambat = selisih('08:30:00', $d->jam_in);
        @endphp
        <span class="badge bg-danger px-2">
            Terlambat {{ $jamterlambat }}
        </span>
    @else
        <span class="badge bg-success px-2">
            Tepat Waktu
        </span>
    @endif
</td>
        </td>
        <td>
            <a href="#" class="btn btn-primary tampilkanpeta" id="{{ $d->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-2"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879" /><path d="M19 18v.01" /></svg>
            </a>
        </td>
    </tr>
@endforeach

<script>
$(function(){

    // =========================
    // EVENT CLICK TOMBOL MAP
    // =========================
    $(document).on('click', '.tampilkanpeta', function(e){

        e.preventDefault();

        // ambil id presensi
        var id = $(this).attr("id");

        // ajax tampilkan map
        $.ajax({
            type: 'POST',
            url: '/tampilkanpeta',

            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },

            cache: false,

            success: function(respond){

                // tampilkan hasil ke modal
                $("#loadmap").html(respond);

                // buka modal bootstrap 5
                var modal = new bootstrap.Modal(
                    document.getElementById('modaltampilkanpeta')
                );

                modal.show();
            },

            error: function(xhr){

                console.log(xhr.responseText);

                alert("Map gagal dimuat");

            }

        });

    });

});
</script>