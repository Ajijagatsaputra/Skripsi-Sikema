<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\TracerStudy;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data tahun akademik dari API OASE
        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/master/tahun-akademik', [
            'key' => env('OASE_API_KEY')
        ]);

        $tahunAkademikList = [];
        $selectedTA = null;

        if ($response->successful() && isset($response['data'])) {
            $tahunAkademikList = $response['data'];

            // Ambil tahun akademik aktif
            $defaultTA = collect($tahunAkademikList)->firstWhere('status', 1);

            // Ambil kode dari input GET, fallback ke tahun aktif
            $selectedTA = request()->input('tahun_akademik', $defaultTA['kode'] ?? null);
        }

        // Ambil jumlah dosen berdasarkan tahun akademik yang dipilih
        $countDosen = $this->getDosenCount($selectedTA);

        $user = Auth::user();

        // Data untuk grafik
        $tahun = range(2021, 2025);
        $alumniData = $this->getAlumniData($tahun);
        $kuisonerData = $this->getKuisionerData($tahun);

        // Jika admin atau superadmin
        if ($user && in_array($user->role, ['admin', 'superadmin'])) {
            $countMahasiswa = $this->getMahasiswaCount();
            $countAlumni = $this->getAlumniCount();
            $statistikAlumni = $this->getStatistikBekerja();

            return view('admin.admin-dashboard', compact(
                'countMahasiswa',
                'countDosen',
                'countAlumni',
                'statistikAlumni',
                'tahun',
                'alumniData',
                'kuisonerData',
                'tahunAkademikList',
                'selectedTA'
            ));
        }

        // Jika user adalah alumni
        $alumni = $user->alumni ?? Alumni::where('id_users', $user->id)->first();
        $hasFilledTracer = $alumni ? TracerStudy::where('id_alumni', $alumni->id)->exists() : false;
        $statusTracer = $hasFilledTracer ? 'sudah' : 'belum';

        return view('main', compact('tahun', 'alumniData', 'kuisonerData', 'statusTracer'));
    }


    private function getMahasiswaCount()
    {
        $key = env('OASE_API_KEY');
        $count = 0;

        for ($tahun = 2020; $tahun <= 2025; $tahun++) {
            $res = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
                'key' => $key,
                'tahun_angkatan' => $tahun
            ]);

            if ($res->successful() && isset($res['data'])) {
                $count += count($res['data']);
            }
        }

        return $count;
    }

 private function getDosenCount($kodeTA)
    {
        $key = env('OASE_API_KEY');
        $kodeProdi = '09';

        $res = Http::get('https://api.oase.poltektegal.ac.id/api/web/dosen', [
            'key' => $key,
            'kd_prodi' => $kodeProdi,
            'kode_tahun_akademik' => $kodeTA
        ]);

        if ($res->successful() && isset($res['data'])) {
            return count($res['data']);
        }

        return 0;
    }



    private function getAlumniCount()
    {
        return DB::table('alumni')->count();
    }

    private function getStatistikBekerja()
    {
        $bekerja = TracerStudy::where('bekerja', 'ya')->count();
        $belum = TracerStudy::where('bekerja', 'tidak')->count();
        $wirausaha = TracerStudy::where('bekerja', 'wirausaha')->count();

        $total = $bekerja + $belum + $wirausaha;

        return [
            'Bekerja' => [
                'jumlah' => $bekerja,
                'persen' => $total ? round(($bekerja / $total) * 100, 1) . '%' : '0%',
            ],
            'Belum Bekerja' => [
                'jumlah' => $belum,
                'persen' => $total ? round(($belum / $total) * 100, 1) . '%' : '0%',
            ],
            'Wirausaha' => [
                'jumlah' => $wirausaha,
                'persen' => $total ? round(($wirausaha / $total) * 100, 1) . '%' : '0%',
            ],
        ];
    }

    private function getAlumniData($tahun)
    {
        $raw = DB::table('alumni')
            ->selectRaw('tahun_lulus as tahun, COUNT(*) as total')
            ->whereBetween('tahun_lulus', [$tahun[0], end($tahun)])
            ->groupBy('tahun_lulus')
            ->pluck('total', 'tahun')
            ->toArray();

        return array_map(fn($t) => $raw[$t] ?? 0, $tahun);
    }

    private function getKuisionerData($tahun)
    {
        $raw = DB::table('tracerstudy')
            ->join('alumni', 'tracerstudy.id_alumni', '=', 'alumni.id')
            ->selectRaw('alumni.tahun_lulus as tahun, COUNT(*) as total')
            ->whereBetween('alumni.tahun_lulus', [$tahun[0], end($tahun)])
            ->groupBy('alumni.tahun_lulus')
            ->pluck('total', 'tahun')
            ->toArray();

        return array_map(fn($t) => $raw[$t] ?? 0, $tahun);
    }
}
