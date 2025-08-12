<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminTracerStudyAlumniController extends Controller
{
    // Menampilkan halaman dengan DataTables
    public function index()
    {
        $totalAlumni = Alumni::count();

        // Total yang sudah mengisi TracerStudy
        $sudahMengisi = TracerStudy::distinct('id_alumni')->count('id_alumni');

        // Yang belum mengisi = total - sudah mengisi
        $belumMengisi = $totalAlumni - $sudahMengisi;

        if (request()->ajax()) {
            // Ambil query TracerStudy dengan relasi alumni dan users
            $tracer = TracerStudy::with('alumni.users');

            // Filter status pekerjaan jika ada
            if (request()->has('status') && request()->status !== '') {
                $status = strtolower(request()->status);
                $tracer->whereRaw('LOWER(bekerja) LIKE ?', ["%$status%"]);
            }

            // Ambil hasil akhir
            $tracer = $tracer->get();

            // Kembalikan data untuk DataTables
            return DataTables::of($tracer)
                ->addColumn('nama_alumni', function ($row) {
                    return $row->alumni && $row->alumni->users
                        ? $row->alumni->users->name
                        : '-';
                })
                ->addColumn('relevansi_pekerjaan', function ($row) {
                    return $row->relevansi_name;
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('listtraceralumni.edit', $row->id);
                    return '
                     <a href="' . $editUrl . '" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">
            <i class="fa fa-trash"></i>
        </button>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        // Return ke view utama jika bukan request Ajax
        return view('admin.tracer.alumni.table-salinan-alumni', compact('totalAlumni', 'sudahMengisi', 'belumMengisi'));
    }


    // Contoh fungsi lain untuk data alumni (jika dibutuhkan)
    public function getData()
    {
        if (request()->ajax()) {
            $query = Alumni::with('users');

            if (request()->filled('tahun_angkatan')) {
                $query->where('tahun_masuk', request('tahun_angkatan'));
            }

            return DataTables::of($query->get())
                ->addColumn('nama', function ($row) {
                    return $row->users ? $row->users->name : '-';
                })
                ->make(true);
        }
    }

    /**
     * Menampilkan form edit data tracer
     */
    public function edit($id)
    {
        $data = TracerStudy::findOrFail($id);
        $alumniList = \App\Models\Alumni::all();
        return view('admin.tracer.alumni.edit-salinan-table', compact('data', 'alumniList'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $data = TracerStudy::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'tahun_lulus' => ['required', 'integer'],
            'alamat' => ['required', 'string', 'max:255'],
            'bekerja' => ['required', 'string', 'in:ya,wirausaha,tidak'],
            // detail pekerjaan
            'nama_perusahaan' => ['nullable', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'alamat_pekerjaan' => ['nullable', 'string', 'max:255'],
            'gaji' => ['nullable', 'string', 'max:255'],
            // detail wirausaha
            'nama_usaha' => ['nullable', 'string', 'max:255'],
            'posisi_usaha' => ['nullable', 'string', 'max:255'],
            'tingkat_usaha' => ['nullable', 'string', 'max:255'],
            'alamat_usaha' => ['nullable', 'string', 'max:255'],
            'pendapatan_usaha' => ['nullable', 'string', 'max:255'],
            // kompetensi
            'etika' => ['required', 'string'],
            'keahlian' => ['required', 'string'],
            'penggunaanteknologi' => ['required', 'string'],
            'teamwork' => ['required', 'string'],
            'komunikasi' => ['required', 'string'],
            'pengembangan' => ['required', 'string'],
            // evaluasi
            'relevansi_kurikulum' => ['required', 'string'],
            'saran' => ['nullable', 'string', 'max:500'],
        ]);

        // Untuk data pekerjaan & wirausaha
        $dataPekerjaan = [
            'nama_perusahaan' => null,
            'jabatan' => null,
            'alamat_pekerjaan' => null,
            'gaji' => null,
            'nama_usaha' => null,
            'posisi_usaha' => null,
            'tingkat_usaha' => null,
            'alamat_usaha' => null,
            'pendapatan_usaha' => null,
        ];
        if ($validated['bekerja'] == 'ya') {
            $dataPekerjaan['nama_perusahaan'] = $validated['nama_perusahaan'];
            $dataPekerjaan['jabatan'] = $validated['jabatan'];
            $dataPekerjaan['alamat_pekerjaan'] = $validated['alamat_pekerjaan'];
            $dataPekerjaan['gaji'] = $validated['gaji'];
        } elseif ($validated['bekerja'] == 'wirausaha') {
            $dataPekerjaan['nama_usaha'] = $validated['nama_usaha'];
            $dataPekerjaan['posisi_usaha'] = $validated['posisi_usaha'];
            $dataPekerjaan['tingkat_usaha'] = $validated['tingkat_usaha'];
            $dataPekerjaan['alamat_usaha'] = $validated['alamat_usaha'];
            $dataPekerjaan['pendapatan_usaha'] = $validated['pendapatan_usaha'];
        }

        // Update data utama
        $data->update([
            'bekerja' => $validated['bekerja'],
            'nama_perusahaan' => $dataPekerjaan['nama_perusahaan'],
            'jabatan' => $dataPekerjaan['jabatan'],
            'alamat_pekerjaan' => $dataPekerjaan['alamat_pekerjaan'],
            'gaji' => $dataPekerjaan['gaji'],
            'nama_usaha' => $dataPekerjaan['nama_usaha'],
            'posisi_usaha' => $dataPekerjaan['posisi_usaha'],
            'tingkat_usaha' => $dataPekerjaan['tingkat_usaha'],
            'alamat_usaha' => $dataPekerjaan['alamat_usaha'],
            'pendapatan_usaha' => $dataPekerjaan['pendapatan_usaha'],
            'etika' => $validated['etika'],
            'keahlian' => $validated['keahlian'],
            'penggunaanteknologi' => $validated['penggunaanteknologi'],
            'teamwork' => $validated['teamwork'],
            'komunikasi' => $validated['komunikasi'],
            'pengembangan' => $validated['pengembangan'],
            'relevansi_pekerjaan' => $validated['relevansi_kurikulum'],
            'saran' => $validated['saran'],
        ]);

        // Update data alumni & user jika perlu
        if ($data->alumni) {
            $data->alumni->update([
                'nama_lengkap' => $validated['nama'],
                'no_hp' => $validated['no_hp'],
                'tahun_lulus' => $validated['tahun_lulus'],
                'alamat' => $validated['alamat'],
            ]);
            if ($data->alumni->users) {
                $data->alumni->users->update([
                    'email' => $validated['email'],
                ]);
            }
        }

        return redirect()->route('listtraceralumni.index')->with('success', 'Data berhasil diupdate!');
    }

    // Hapus
    public function destroy($id)
    {
        $tracer = TracerStudy::findOrFail($id);
        $tracer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
