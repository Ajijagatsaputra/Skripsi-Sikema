<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function getTahunAkademik()
    {
        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/master/tahun-akademik', [
            'key' => env('OASE_API_KEY')
        ]);

        return response()->json($response->json());
    }
    public function getDataDosen(Request $request)
    {
        $tahun = $request->input('kode_tahun_akademik');

        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/dosen', [
            'key' => env('OASE_API_KEY'),
            'kd_prodi' => '09',
            'kode_tahun_akademik' => $tahun
        ]);

        $json = $response->json();

        if (!isset($json['data']) || !is_array($json['data'])) {
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Data dosen tidak tersedia atau tidak valid'
            ]);
        }

        return response()->json([
            'status' => true,
            'data' => $json['data']
        ]);
    }
}
