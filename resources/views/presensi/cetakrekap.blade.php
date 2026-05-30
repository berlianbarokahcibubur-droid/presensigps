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
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #title {
            font-size: 18px;
            font-weight: bold;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi th {
            border: 1px solid #000;
            padding: 5px;
            background-color: #dcdcdc;
            font-size: 12px;
            text-align: center;
        }

        .tabelpresensi td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 11px;
            text-align: center;
        }

        .text-left {
            text-align: left !important;
        }

        .terlambat {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body class="A4 landscape">

    <section class="sheet padding-10mm">

        <table style="width:100%">
            <tr>
                <td style="width:90px;">
                    <img src="{{ asset('assets/img/logo-satu8.JPG') }}"
                        width="70"
                        height="70">
                </td>

                <td>
                    <span id="title">
                        REKAP PRESENSI KARYAWAN <br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
                        SATU 8 RESIDENCE
                    </span>
                    <br>

                    <span style="font-size:12px;">
                        <i>
                            Jl. Pilar Komp. Delta Kedoya Kav. 18, Blok S,
                            Kedoya Selatan, Kebon Jeruk, Jakarta Barat
                        </i>
                    </span>
                </td>
            </tr>
        </table>

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

            @php
                $no = 1;
            @endphp

            @foreach ($rekap as $d)

            <tr>

                <td>{{ $no++ }}</td>

                <td>{{ $d->nik }}</td>

                <td class="text-left">
                    {{ $d->nama_lengkap }}
                </td>

                @for ($i = 1; $i <= 31; $i++)

                    @php
                        $field = 'tgl_'.$i;
                        $value = $d->$field;

                        // ambil jam masuk
                        $jammasuk = substr($value,0,8);

                        // cek terlambat
                        $isTerlambat = $jammasuk > '08:30:00';
                    @endphp

                    <td class="{{ $isTerlambat ? 'terlambat' : '' }}">
                        {{ $value }}
                    </td>

                @endfor

                <td>
                    {{ $d->total_hadir }}
                </td>

                <td class="{{ $d->total_terlambat > 0 ? 'terlambat' : '' }}">
                    {{ $d->total_terlambat }}
                </td>

            </tr>

            @endforeach

        </table>

        <table width="100%" style="margin-top:50px;">
            <tr>
                <td colspan="2"
                    style="text-align:right; padding-right:30px;">
                    Jakarta, {{ date('d-m-Y') }}
                </td>
            </tr>

            <tr>
                <td style="text-align:center; width:50%;">
                    Mengetahui,
                </td>

                <td style="text-align:center; width:50%;">
                    Disetujui Oleh,
                </td>
            </tr>

            <tr>
                <td style="height:80px;"></td>
                <td></td>
            </tr>

            <tr>
                <td style="text-align:center;">
                    <u><b>Nama HRD</b></u><br>
                    <i>HRD Manager</i>
                </td>

                <td style="text-align:center;">
                    <u><b>Nama Direksi</b></u><br>
                    <i>Direksi</i>
                </td>
            </tr>
        </table>

    </section>

</body>
</html>