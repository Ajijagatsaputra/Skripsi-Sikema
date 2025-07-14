<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
            'key' => env('OASE_API_KEY'),
        ]);

        return view('admin.admin-dashboard');
    }

    public function DataAlumni()
    {
        $tahunSekarang = Carbon::now()->year;
        $tahunAwal = 2021;


        // Ambil data alumni per tahun
        $alumniPerTahun = DB::table('alumni')
            ->select(DB::raw('YEAR(tanggal_lulus) as tahun'), DB::raw('COUNT(*) as total'))
            ->whereBetween(DB::raw('YEAR(tanggal_lulus)'), [$tahunAwal, $tahunSekarang])
            ->groupBy(DB::raw('YEAR(tanggal_lulus)'))
            ->pluck('total', 'tahun');

        // Ambil data kuesioner yang sudah diisi (tracer study) per tahun
        $kuisonerPerTahun = DB::table('kuisoner')
            ->join('alumni', 'kuisoner.alumni_id', '=', 'alumni.id')
            ->select(DB::raw('YEAR(alumni.tanggal_lulus) as tahun'), DB::raw('COUNT(*) as total'))
            ->whereBetween(DB::raw('YEAR(alumni.tanggal_lulus)'), [$tahunAwal, $tahunSekarang])
            ->groupBy(DB::raw('YEAR(alumni.tanggal_lulus)'))
            ->pluck('total', 'tahun');

        // Kirim data ke view
        return view('dashboard.index', [
            'alumniPerTahun' => $alumniPerTahun,
            'kuisonerPerTahun' => $kuisonerPerTahun,
            'tahun' => range($tahunAwal, $tahunSekarang)
        ]);
    }
}
