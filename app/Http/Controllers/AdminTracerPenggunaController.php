<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\tracer_pengguna;
use App\Models\TracerPengguna;
use Illuminate\Http\Request;

class AdminTracerPenggunaController extends Controller
{
    /**
     * Menampilkan data tracer untuk admin
     */
    public function index(Request $request)
    {
        $query = TracerPengguna::query();

        // Filter berdasarkan prodi jika ada
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            if ($request->status == 'sudah_mengisi') {
                $query->whereNotNull('created_at');
            }
        }

        // Filter berdasarkan tahun jika ada
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->latest()->paginate(10);
 $totalAlumni = Alumni::count();
    // Asumsi: field relasi alumni di tracer_pengguna adalah alumni_id
    // Jika tidak ada, sesuaikan fieldnya!
    $sudahMengisi = TracerPengguna::distinct('user_id')->count('user_id');
    $belumMengisi = $totalAlumni - $sudahMengisi;
        // Ambil data untuk filter dropdown
        $prodis = TracerPengguna::distinct()->pluck('prodi');
        $tahuns = TracerPengguna::selectRaw('YEAR(created_at) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        return view('admin.tracer.pengguna.table-salinan-pengguna', compact('data', 'prodis', 'tahuns','totalAlumni', 'sudahMengisi', 'belumMengisi'));
    }

    /**
     * Menampilkan detail data tracer
     */
    public function show($id)
    {
        $data = TracerPengguna::findOrFail($id);
        return view('admin.tracer.pengguna.detail-salinan-table', compact('data'));
    }

    /**
     * Menampilkan form edit data tracer
     */
    public function edit($id)
    {
        $data = TracerPengguna::findOrFail($id);
        return view('admin.tracer.pengguna.edit-salinan-table', compact('data'));
    }

    /**
     * Update data tracer
     */
    public function update(Request $request, $id)
    {
        $data = TracerPengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'prodi' => 'required|string',
            'jabatan' => 'nullable|string',

            // Survey Kompetensi Lulusan
            'integritas' => 'required|string',
            'keahlian' => 'required|string',
            'kemampuan' => 'required|string',
            'penguasaan' => 'required|string',
            'komunikasi' => 'required|string',
            'kerja_tim' => 'required|string',
            'pengembangan' => 'required|string',

            // Penilaian Atasan
            'nama_atasan' => 'nullable|string',
            'nip_atasan' => 'nullable|string',
            'posisi_jabatan_atasan' => 'nullable|string',
            'nama_perusahaan' => 'nullable|string',
            'alamat_perusahaan' => 'nullable|string',

            // Saran
            'saran' => 'nullable|string'
        ]);

        $data->update($request->all());

        return redirect()->route('listtracerpengguna.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data tracer
     */
    public function destroy($id)
    {
        $data = TracerPengguna::findOrFail($id);
        $data->delete();

        return redirect()->back()
            ->with('success', 'Data berhasil dihapus.');
    }

    /**
     * Export data tracer
     */
    public function export(Request $request)
    {
        $query = TracerPengguna::query();

        // Apply same filters as index
        if ($request->filled('prodi')) {
            $query->where('prodi', $request->prodi);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $data = $query->get();

        // Return as JSON for DataTables export or implement Excel/PDF export
        return response()->json($data);
    }

    /**
     * Get statistics for dashboard
     */
    public function getStatistics()
    {
        $total = TracerPengguna::count();
        $thisMonth = TracerPengguna::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $byProdi = TracerPengguna::selectRaw('prodi, COUNT(*) as total')
            ->groupBy('prodi')
            ->get();

        return [
            'total' => $total,
            'this_month' => $thisMonth,
            'by_prodi' => $byProdi
        ];
    }
}
