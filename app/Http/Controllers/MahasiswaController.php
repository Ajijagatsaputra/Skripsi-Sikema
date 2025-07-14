<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function getData(Request $request)
    /**
     * Mendapatkan data mahasiswa berdasarkan tahun angkatan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    {
        $tahun = $request->input('tahun_angkatan');

        $response = Http::get('https://api.oase.poltektegal.ac.id/api/web/mahasiswa', [
            'key' => env('OASE_API_KEY'),
            'tahun_angkatan' => $tahun
        ]);

        return response()->json($response->json());
    }
}

