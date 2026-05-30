<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini  = date("Y-m-d");
        $bulanini = (int) date("m");
        $tahunini = date("Y");

        $user = Auth::guard('karyawan')->user();

        // Default data
        $presensihariini = null;
        $historibulanini = [];
        $rekappresensi   = (object)[
            'jmlhadir' => 0,
            'jmlterlambat' => 0,
        ];

        if ($user) {
            $nik = $user->nik;

            /*
            |--------------------------------------------------------------------------
            | Presensi Hari Ini
            |--------------------------------------------------------------------------
            */
            $presensihariini = DB::table('presensi')
                ->where('nik', $nik)
                ->where('tgl_presensi', $hariini)
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Histori Presensi Bulan Ini
            |--------------------------------------------------------------------------
            */
            $historibulanini = DB::table('presensi')
                ->where('nik', $nik)
                ->whereMonth('tgl_presensi', $bulanini)
                ->whereYear('tgl_presensi', $tahunini)
                ->orderBy('tgl_presensi', 'desc')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Rekap Presensi Bulan Ini
            |--------------------------------------------------------------------------
            */
            $rekappresensi = DB::table('presensi')
            ->selectRaw("COUNT(nik) as jmlhadir,SUM(IF(jam_in > '08:30:00',1,0)) as jmlterlambat")
            ->where('nik', $nik)
            ->whereMonth('tgl_presensi', $bulanini)
            ->whereYear('tgl_presensi', $tahunini)
            ->first();
        }

        $leaderboard = DB::table('presensi')
        ->join('karyawan','presensi.nik','=','karyawan.nik')
        ->orderBy('jam_in')
        ->where('tgl_presensi',$hariini)
        ->get();

        $namabulan = [
            "",
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        $rekapizin = DB::table('izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereMonth('tgl_izin', $bulanini)
        ->whereYear('tgl_izin', $tahunini)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboard', compact(
            'presensihariini',
            'historibulanini',
            'rekappresensi',
            'namabulan',
            'bulanini',
            'tahunini',
            'leaderboard',
            'rekapizin'
        ));
    }

    public function dashboardadmin()
    {
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
            ->selectRaw("COUNT(nik) as jmlhadir,SUM(IF(jam_in > '08:30:00',1,0)) as jmlterlambat")
            ->where('tgl_presensi',$hariini)
            ->first();

            $rekapizin = DB::table('izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin,SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin',$hariini)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboardadmin',compact('rekappresensi','rekapizin'));
    }
}