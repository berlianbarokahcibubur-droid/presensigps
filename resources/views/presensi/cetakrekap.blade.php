<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rekap Presensi</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .sheet {
            padding: 10mm !important;
        }

        /* HEADER */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            display: block;
            margin: 0 auto 10px auto;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            line-height: 1.4;
        }

        .header-address {
            font-size: 12px;
            font-style: italic;
            margin-top: 5px;
        }

        /* TABLE */
        .tabelpresensi {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabelpresensi th {
            border: 1px solid #000;
            padding: 4px;
            font-size: 11px;
            background: #dcdcdc;
            text-align: center;
        }

        .tabelpresensi td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
            text-align: center;
        }

        .text-left {
            text-align: left !important;
        }

        .terlambat {
            color: red;
            font-weight: bold;
        }

        /* FOOTER */
        .ttd {
            width: 100%;
            margin-top: 50px;
            border-collapse: collapse;
        }

        .ttd td {
            text-align: center;
        }

        .tanggal {
            text-align: right !important;
            padding-right: 30px;
            padding-bottom: 20px;
        }

        .space-ttd {
            height: 90px;
        }
    </style>
</head>

<body class="A4 landscape">

<section class="sheet">

    <!-- HEADER -->
    <div class="header">

        <img src="{{ asset('assets/img/logo-satu8.JPG') }}"
             width="70"
             height="70">

        <div class="header-title">
            REKAP PRESENSI KARYAWAN <br>
            PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
            SATU 8 RESIDENCE
        </div>

        <div class="header-address">
            Jl. Pilar Komp. Delta Kedoya Kav. 18, Blok S,
            Kedoya Selatan, Kebon Jeruk, Jakarta Barat
        </div>

    </div>

    <!-- TABEL -->
    <table class="tabelpresensi">

        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">NIK</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">Total Hadir</th>
            <th rowspan="2">Total Terlambat</th>
        </tr>

        <tr>
            @for ($i = 1; $i <= 31; $i++)
                <th>{{ $i }}</th>
            @endfor
        </tr>

        @php $no = 1; @endphp

        @foreach ($rekap as $d)

        <tr>

            <td>{{ $no++ }}</td>

            <td>'{{ $d->nik }}</td>

            <td class="text-left">
                {{ $d->nama_lengkap }}
            </td>

            @for ($i = 1; $i <= 31; $i++)

                @php
                    $field = 'tgl_'.$i;
                    $value = $d->$field;

                    $jammasuk = substr($value,0,8);

                    $isTerlambat =
                        !empty($jammasuk) &&
                        $jammasuk > '08:30:00';
                @endphp

                <td class="{{ $isTerlambat ? 'terlambat' : '' }}">
                    {{ $value }}
                </td>

            @endfor

            <td>{{ $d->total_hadir }}</td>

            <td class="{{ $d->total_terlambat > 0 ? 'terlambat' : '' }}">
                {{ $d->total_terlambat }}
            </td>

        </tr>

        @endforeach

    </table>

    <!-- TTD -->
    <table class="ttd">

        <tr>
            <td colspan="2" class="tanggal">
                Jakarta, {{ date('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <td width="50%">
                Mengetahui,
            </td>

            <td width="50%">
                Disetujui Oleh,
            </td>
        </tr>

        <tr>
            <td class="space-ttd"></td>
            <td></td>
        </tr>

        <tr>
            <td>
                <u><b>Nama HRD</b></u><br>
                <i>HRD Manager</i>
            </td>

            <td>
                <u><b>Nama Direksi</b></u><br>
                <i>Direksi</i>
            </td>
        </tr>

    </table>

</section>

</body>
</html>