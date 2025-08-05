<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PrediksiController extends Controller
{

    public function showForm()
    {
        return view('prediksi'); // pastikan file prediksi.blade.php ada di resources/views
    }

    public function predictOutcome(Request $request)
    {
        $validated = $request->validate([
            'discrete1' => 'required|numeric|between:1,6',
            'discrete2' => 'required|numeric|between:1,6',
            'discrete3' => 'required|numeric|between:1,6',
            'discrete4' => 'required|numeric|between:1,6',
            'continuous5' => 'required|numeric|between:0,1',
            'continuous6' => 'required|numeric|between:0,1',
            'continuous7' => 'required|numeric|between:0,1',
            'continuous8' => 'required|numeric|between:0,1',
            'continuous9' => 'required|numeric|between:0,1',
            'continuous10' => 'required|numeric|between:0,1',
            'continuous11' => 'required|numeric|between:0,1',
            'continuous12' => 'required|numeric|between:0,1',
            'continuous13' => 'required|numeric|between:0,1',
            'continuous14' => 'required|numeric|between:0,1',
        ]);

        $response = Http::post('http://127.0.0.1:5000/predict', [
            'features' => array_values($validated)
        ]);

        $data = $response->json();

        if (!$data || !isset($data['prediction'])) {
            return back()->with('error', 'Gagal mendapatkan prediksi dari model.');
        }

        $prediction = $data['prediction'];

        return view('prediksi', compact('prediction'));
    }
}
