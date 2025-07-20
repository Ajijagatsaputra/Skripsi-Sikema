<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Alumni;

class ProfileAlumniController extends Controller
{
    public function show()
    {
        $alumni = Auth::user()->alumni;
        return view('components.profile', compact('alumni'));
    }

public function update(Request $request)
{
    $request->validate([
        'nim' => 'required|string',
        'nama_lengkap' => 'required|string',
        'prodi' => 'nullable|string',
        'kelas' => 'nullable|string',
        'jalur' => 'nullable|string',
        'no_hp' => 'nullable|string|max:15',
        'alamat' => 'nullable|string',
        'tahun_masuk' => 'nullable|integer',
        'tahun_lulus' => 'nullable|integer',
        'status_mahasiswa' => 'nullable|string',
    ]);

    $alumni = Auth::user()->alumni;

    if (!$alumni) {
        return redirect()->back()->with('error', 'Data alumni tidak ditemukan.');
    }

    $alumni->update($request->only([
        'nim',
        'nama_lengkap',
        'prodi',
        'kelas',
        'jalur',
        'no_hp',
        'alamat',
        'tahun_masuk',
        'tahun_lulus',
        'status_mahasiswa'
    ]));

    return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
}


}
