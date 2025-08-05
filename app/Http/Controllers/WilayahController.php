<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;

class WilayahController extends Controller
{
    public function getProvinsi()
    {
        $provinces = Province::pluck('name', 'code');
        return response()->json($provinces);
    }

    public function getKota($provinceCode)
    {
        $cities = City::where('province_code', $provinceCode)->pluck('name', 'code');
        return response()->json($cities);
    }
}
