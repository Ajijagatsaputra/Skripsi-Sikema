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
            background: linear-gradient(135deg, #f9f9fa 0%, #ffffff 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .questionnaire-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header-section {
            background: linear-gradient(135deg, #1763a5 0%, #085ddd 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px 25px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, #132ad6 0%, #1f12ce 100%);
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white !important;
        }
    </style>
</head>

@extends('layout')

@section('content')
    @include('components.navbar')

    <body>
        <div class="container mt-4 mb-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-4 mx-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="questionnaire-container">
                <!-- Header -->
                <div class="header-section">
                    <h1>Tracer Study Tahun 2025 Politeknik Harapan Bersama</h1>
                    <p>Kuesioner untuk mengetahui perkembangan karir dan evaluasi pendidikan alumni</p>
                </div>

                <div class="p-4">
                    <form id="alumniForm" action="{{ route('tracer.store') }}" method="POST">
                        @csrf
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
                                            placeholder="Masukkan nama lengkap" value="{{ $alumni->nama_lengkap ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <input type="text" name="alamat" class="form-control"
                                            placeholder="Desa, Kecamatan, Kabupaten" value="{{ $alumni->alamat ?? '' }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Program Studi</label>
                                        <select name="prodi" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Program Studi --</option>
                                            <option value="teknik_informatika">Teknik Informatika</option>
                                            <option value="sistem_informasi">Sistem Informasi</option>
                                            <option value="manajemen">Manajemen</option>
                                            <option value="akuntansi">Akuntansi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Posisi/Jabatan Pekerja</label>
                                        <input type="text" name="jabatan" class="form-control"
                                            placeholder="Software Developer" required>
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
                                    <div class="col-md-6">
                                        <label class="form-label">Integritas</label>
                                        <select name="integritas" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Keahlian</label>
                                        <select name="keahlian" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kemampuan</label>
                                        <select name="kemampuan" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Penguasaan</label>
                                        <select name="penguasaan" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Komunikasi</label>
                                        <select name="komunikasi" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kerja Tim</label>
                                        <select name="kerja_tim" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pengembangan</label>
                                        <select name="pengembangan" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
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
                                            placeholder="Nama Atasan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIP Atasan</label>
                                        <input type="text" name="nip_atasan" class="form-control"
                                            placeholder="NIP Atasan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Posisi Jabatan Atasan</label>
                                        <input type="text" name="posisi_jabatan_atasan" class="form-control"
                                            placeholder="Posisi Jabatan Atasan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control"
                                            placeholder="Nama Perusahaan" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat Perusahaan</label>
                                        <input type="text" name="alamat_perusahaan" class="form-control"
                                            placeholder="Alamat Perusahaan" required>
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
                                    placeholder="Tulis saran, kritik, atau masukan Anda di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-submit">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Kuesioner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    </body>
@endsection

</html>
