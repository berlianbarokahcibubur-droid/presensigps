<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }
    #title{
        font-family: Arial, Helvetica, sans-serif,;
        font-size: 18px;
        font-weight: bold;
    }

    .tabeldatakaryawan{
        margin-top: 40px;
    }

    .tabelpresensi{
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tabelpresensi tr th{
        border: 1px solid #0e0d0d;
        padding: 8px;
        background-color: #eeeaea;
    }

    .tabelpresensi  tr  td{
        border: 1px solid #0e0d0d;
        padding: 5px;
        font-size: 12px;
    }
    
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
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

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
        <tr>
            <td style="width: 30px">
                <img src="{{ asset('assets/img/logo-satu8.JPG') }}" width="70" height="70" alt="">
            </td>
            <td>
                <span id="title">
                    LAPORAN PRESENSI KARYAWAN <br>
                    PERIODE {{ strtoupper( $namabulan[$bulan]) }} {{ $tahun }} <br>
                    SATU 8 RESIDENCE<br>
                </span>
                <span><i>
                    Jl. Pilar Komp. Delta Kedoya Kav. 18, Blok S, Kedoya Selatan, Kebon Jeruk, Jakarta Barat, Daerah Khusus Ibukota Jakarta
                </i>
                </span>
            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>'{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_dept }}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp }}</td>
        </tr>
    </table>
    ```php
<table class="tabelpresensi">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Pulang</th>
        <th>Keterangan</th>
        <th>Jam Kerja</th>
    </tr>
    @foreach ($presensi as $d)
    @php
        if($d->jam_out != null){
            $j1 = strtotime($d->jam_in);
            $j2 = strtotime($d->jam_out);
            $selisih = $j2 - $j1;
            $jam = floor($selisih / 3600);
            $menit = floor(($selisih % 3600) / 60);
            $jamkerja = $jam . " Jam " . $menit . " Menit";
        }else{
            $jamkerja = "-";
        }
    @endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>
            {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}
        </td>
        <td>
            {{ $d->jam_in }}
        </td>
        <td>
            {{ $d->jam_out ?? 'Belum Absen' }}
        </td>
        <td>
            @if($d->jam_in > '08:30:00')
                Terlambat
            @else
                Tepat Waktu
            @endif
        </td>
        <td>
            {{ $jamkerja }}
        </td>
    </tr>
    @endforeach
</table>

    <table width="100%" style="margin-top: 80px">
    <tr>
        <td colspan="2" style="text-align: right; padding-right: 30px;">
            Jakarta, {{ date('d-m-Y') }}
        </td>
    </tr>
    <tr>
        <td style="text-align: center; width:50%;">
            Mengetahui,
        </td>
        <td style="text-align: center; width:50%;">
            Disetujui Oleh,
        </td>
    </tr>
    <tr>
        <td style="height: 100px;"></td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <u><b>Nama HRD</b></u><br>
            <i>HRD Manager</i>
        </td>
        <td style="text-align: center;">
            <u><b>Nama Direksi</b></u><br>
            <i>Direksi</i>
        </td>
    </tr>
</table>
  </section>
</body>
</html>