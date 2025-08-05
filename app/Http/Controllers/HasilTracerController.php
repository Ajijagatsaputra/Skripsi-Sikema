<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\TracerPengguna;
use Illuminate\Http\Request;
use PHPUnit\Event\Tracer\Tracer;

class HasilTracerController extends Controller
{
    public function index()
    {
        $nilaiMap = [
            'tidak_baik'   => 1,
            'kurang_baik'  => 2,
            'cukup'        => 3,
            'baik'         => 4,
            'sangat_baik'  => 5,
        ];

        $indikator = [
            'integritas'   => 'Integritas',
            'keahlian'     => 'Keahlian',
            'kemampuan'    => 'Kemampuan',
            'penguasaan'   => 'Penguasaan',
            'komunikasi'   => 'Komunikasi',
            'kerja_tim'    => 'Kerja Tim',
            'pengembangan' => 'Pengembangan Diri'
        ];

        $totalAlumni   = Alumni::count();
        $sudahMengisi  = TracerPengguna::count();
        $belumMengisi  = $totalAlumni - $sudahMengisi;

        $hasil = [];
        foreach ($indikator as $field => $label) {
            $data = TracerPengguna::select($field)->get()->pluck($field)->map(function ($v) use ($nilaiMap) {
                return $nilaiMap[strtolower($v)] ?? 0;
            });

            $rekap = [
                1 => $data->where(fn($v) => $v == 1)->count(),
                2 => $data->where(fn($v) => $v == 2)->count(),
                3 => $data->where(fn($v) => $v == 3)->count(),
                4 => $data->where(fn($v) => $v == 4)->count(),
                5 => $data->where(fn($v) => $v == 5)->count(),
            ];

            $jumlahResponden = $data->filter()->count();
            $rataRata = $jumlahResponden ? round($data->sum() / $jumlahResponden, 2) : 0;
            $keterangan = $this->getKategoriNilai($rataRata);

            $totalNilai = 0;
            foreach ($rekap as $nilai => $jumlah) {
                $totalNilai += $nilai * $jumlah;
            }

            $presentase = ($jumlahResponden > 0)
                ? round(($totalNilai / ($jumlahResponden * 5)) * 100, 1)
                : 0;

            $hasil[] = [
                'label' => $label,
                'rekap' => $rekap,
                'jumlah_responden' => $jumlahResponden,
                'rata_rata' => $rataRata,
                'keterangan' => $keterangan,
                'nilai_total' => $presentase,
            ];
        }

        // Kesimpulan
        $totalNilai = 0;
        $totalIndikator = 0;
        $totalResponden = 0;
        foreach ($hasil as $row) {
            $totalNilai += $row['rata_rata'];
            $totalIndikator++;
            $totalResponden += $row['jumlah_responden'];
        }

        $kesimpulanRataRata = $totalIndikator ? round($totalNilai / $totalIndikator, 2) : 0;
        $kesimpulanKategori = $this->getKategoriNilai($kesimpulanRataRata);

        $nilaiMaksimal = $totalResponden * 5;
        $totalNilaiSeluruh = 0;
        foreach ($hasil as $row) {
            $totalNilaiSeluruh += $row['rata_rata'] * $row['jumlah_responden'];
        }

        $kesimpulanPersentase = $nilaiMaksimal > 0
            ? round(($totalNilaiSeluruh / $nilaiMaksimal) * 100, 1)
            : 0;

        return view('admin.tracer.hasil', compact(
            'totalAlumni',
            'sudahMengisi',
            'belumMengisi',
            'hasil',
            'kesimpulanKategori',
            'kesimpulanRataRata',
            'kesimpulanPersentase'
        ));
    }

    private function getKategoriNilai($nilai)
    {
        if ($nilai >= 4.5) return 'Sangat Baik';
        if ($nilai >= 3.5) return 'Baik';
        if ($nilai >= 2.5) return 'Cukup';
        if ($nilai >= 1.5) return 'Kurang Baik';
        if ($nilai > 0)    return 'Tidak Baik';
        return '-';
    }
}
