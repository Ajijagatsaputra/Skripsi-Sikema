<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuesioner Tracer Study Alumni</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/logo_phb.png">
    <style>
        body {
            background: linear-gradient(135deg, #f0f2f5 0%, #ffffff 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            padding: 20px 0;
        }

        .questionnaire-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header-section {
            background: linear-gradient(135deg, #1763a5, #085ddd);
            color: white;
            padding: 50px 30px;
            text-align: center;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .section-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .section-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px 30px;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-body {
            padding: 25px 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control,
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1763a5;
            box-shadow: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #132ad6 0%, #1f12ce 100%);
            border: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-size: 1.05rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0f25b5, #1a10b2);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            border: 2px solid #ced4da;
            color: #333;
            background-color: #fff;
            padding: 14px 30px;
            border-radius: 50px;
            font-size: 1.05rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background-color: #f1f3f5;
            border-color: #adb5bd;
            color: #000;
            transform: translateY(-1px);
        }

        .text-center .btn i {
            margin-right: 8px;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        @media (max-width: 768px) {
            .section-header {
                font-size: 1.1rem;
            }
        }
    </style>

</head>

@extends('layout')

@section('content')
    @include('components.navbar')

    <body>
        <div class="container mt-4 mb-4">
            <div class="questionnaire-container">
                <!-- Header -->
                <div class="header-section">
                    <h1>Edit Salinan Tracer Pengguna Alumni</h1>
                    <p>Perbarui data tracer pengguna alumni Anda</p>
                </div>

                <div class="p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4 mx-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="alumniForm" action="{{ route('tracer.kuesioner-pengguna.update', $data->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Informasi Pribadi -->
                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-user"></i>
                                Informasi Pribadi
                            </div>
                            <div class="section-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ old('nama', $data->nama) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <input type="text" name="alamat" class="form-control"
                                            value="{{ old('alamat', $data->alamat) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Program Studi</label>
                                        <select name="prodi" class="form-select" required>
                                            <option value="" disabled>-- Pilih Program Studi --</option>
                                            <option value="teknik_informatika"
                                                {{ old('prodi', $data->prodi) == 'teknik_informatika' ? 'selected' : '' }}>
                                                Teknik Informatika</option>
                                            <option value="sistem_informasi"
                                                {{ old('prodi', $data->prodi) == 'sistem_informasi' ? 'selected' : '' }}>
                                                Sistem Informasi</option>
                                            <option value="manajemen"
                                                {{ old('prodi', $data->prodi) == 'manajemen' ? 'selected' : '' }}>Manajemen
                                            </option>
                                            <option value="akuntansi"
                                                {{ old('prodi', $data->prodi) == 'akuntansi' ? 'selected' : '' }}>Akuntansi
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Posisi/Jabatan Pekerja</label>
                                        <input type="text" name="jabatan" class="form-control"
                                            value="{{ old('jabatan', $data->jabatan) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Survey Kompetensi Lulusan -->
                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-star"></i>
                                Survey Kompetensi Lulusan
                            </div>
                            <div class="section-body">
                                <label class="form-label">Penilaian Kompetensi</label>
                                <div class="row g-4">
                                    @php
                                        $opts = [
                                            'sangat_baik' => 'Sangat Baik',
                                            'baik' => 'Baik',
                                            'cukup' => 'Cukup',
                                            'kurang_baik' => 'Kurang Baik',
                                            'tidak_baik' => 'Tidak Baik',
                                        ];
                                    @endphp
                                    <div class="col-md-6">
                                        <label class="form-label">Integritas</label>
                                        <select name="integritas" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('integritas', $data->integritas) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Keahlian Bidang Ilmu</label>
                                        <select name="keahlian" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('keahlian', $data->keahlian) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kemampuan</label>
                                        <select name="kemampuan" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('kemampuan', $data->kemampuan) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Penguasaan Teknologi Informasi</label>
                                        <select name="penguasaan" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('penguasaan', $data->penguasaan) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Komunikasi</label>
                                        <select name="komunikasi" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('komunikasi', $data->komunikasi) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kerjasama Tim</label>
                                        <select name="kerja_tim" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('kerja_tim', $data->kerja_tim) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pengembangan Diri</label>
                                        <select name="pengembangan" class="form-select" required>
                                            <option value="">-- Pilih Level --</option>
                                            @foreach ($opts as $key => $val)
                                                <option value="{{ $key }}"
                                                    {{ old('pengembangan', $data->pengembangan) == $key ? 'selected' : '' }}>
                                                    {{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penilaian Atasan -->
                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-user-tie"></i>
                                Penilaian Atasan
                            </div>
                            <div class="section-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Atasan</label>
                                        <input type="text" name="nama_atasan" class="form-control"
                                            value="{{ old('nama_atasan', $data->nama_atasan) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIP Atasan</label>
                                        <input type="text" name="nip_atasan" class="form-control"
                                            value="{{ old('nip_atasan', $data->nip_atasan) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Posisi Jabatan Atasan</label>
                                        <input type="text" name="posisi_jabatan_atasan" class="form-control"
                                            value="{{ old('posisi_jabatan_atasan', $data->posisi_jabatan_atasan) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control"
                                            value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat Perusahaan</label>
                                        <input type="text" name="alamat_perusahaan" class="form-control"
                                            value="{{ old('alamat_perusahaan', $data->alamat_perusahaan) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Saran -->
                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-comments"></i>
                                Saran dan Masukan
                            </div>
                            <div class="section-body">
                                <label class="form-label">Berikan saran atau kritik untuk perbaikan kurikulum dan fasilitas
                                    kampus</label>
                                <textarea name="saran" rows="5" class="form-control"
                                    placeholder="Tulis saran, kritik, atau masukan Anda di sini...">{{ old('saran', $data->saran) }}</textarea>
                            </div>
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary me-2">
                                <i class="fas fa-save me-2"></i>
                                Simpan Perubahan
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
        <script src="{{ asset('assets/js/plugins/penggunatables/jquery.penggunaTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/penggunatables-bs5/js/penggunaTables.bootstrap5.min.js') }}"></script>
    </body>
@endsection

</html>
