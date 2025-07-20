<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kuesioner Tracer Study Alumni</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/logo_phb.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #007bff;
            --light-blue: #e0eafc;
            --dark-blue: #0056b3;
            --accent-blue: #66b3ff;
            --text-dark: #34495e;
            --text-light: #ffffff;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --shadow-medium: rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-blue);
            background: linear-gradient(135deg, var(--light-blue) 0%, #cfdef3 100%);
            min-height: 100vh;
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .questionnaire-container {
            background: var(--text-light);
            border-radius: 25px;
            box-shadow: 0 15px 30px var(--shadow-light);
            padding: 40px;
            margin-top: 30px;
            max-width: 900px;
            width: 95%;
            transition: all 0.3s ease-in-out;
        }

        .header-section {
            background: linear-gradient(45deg, #007bff 0%, #0056b3 100%); /* Blue gradient */
            color: var(--text-light);
            padding: 45px 30px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 40px;
            box-shadow: 0 10px 20px var(--shadow-light);
        }

        .header-section h1 {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select,
        .input-group-text {
            border: 1px solid #ced4da;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 1rem;
            transition: all 0.3s ease-in-out;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Blue shadow on focus */
            outline: none;
        }

        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group-text {
            background-color: #e9ecef;
            border-right: none;
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
            color: #495057;
        }

        .btn-submit {
            background: linear-gradient(45deg, var(--primary-blue) 0%, var(--dark-blue) 100%); /* Blue gradient for button */
            border: none;
            padding: 15px 45px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-light) !important;
            box-shadow: 0 8px 15px var(--shadow-light);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px var(--shadow-medium);
            background: linear-gradient(45deg, var(--dark-blue) 0%, var(--primary-blue) 100%); /* Inverted gradient on hover */
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--text-dark);
            background: #f8f9fa;
            padding: 15px 20px;
            margin-top: 40px;
            margin-bottom: 25px;
            border-left: 5px solid var(--primary-blue); /* Blue accent bar */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .alert-success-custom { /* Custom class for SweetAlert styling */
            background-color: #d1ecf1; /* Light cyan */
            color: #0c5460; /* Dark cyan */
            border-color: #bee5eb;
        }
        .swal2-icon.swal2-success {
            border-color: var(--primary-blue) !important;
        }
        .swal2-icon.swal2-success [class^=swal2-success-line][class$=long] {
            background-color: var(--primary-blue) !important;
        }
        .swal2-icon.swal2-success [class^=swal2-success-line][class$=tip] {
            background-color: var(--primary-blue) !important;
        }
    </style>
</head>

@extends('layout')

@section('content')
@include('components.navbar')

<body>
    <div class="container questionnaire-container">
        <div class="header-section mb-4">
            <h1>Edit Kuesioner Tracer Study</h1>
            <p>Perbarui data tracer study alumni Anda dengan detail terbaru</p>
        </div>

        <form method="POST" action="{{ route('kuesioner.update', ['id' => $tracer->id]) }}">
            @csrf
            @method('PUT')

            <div class="section-title"><i class="fas fa-user-circle me-2"></i>Informasi Pribadi</div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $alumni->nama_lengkap ?? '') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $alumni->no_hp ?? '') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Aktif</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                    <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $alumni->alamat ?? '') }}" required>
                </div>
            </div>

            <div class="section-title"><i class="fas fa-briefcase me-2"></i>Status Saat Ini</div>
            <div class="mb-3">
                <label for="bekerja" class="form-label">Status</label>
                <select name="bekerja" id="bekerja" class="form-select" required>
                    <option value="ya" {{ old('bekerja', $tracer->bekerja ?? '') == 'ya' ? 'selected' : '' }}>Bekerja</option>
                    <option value="wirausaha" {{ old('bekerja', $tracer->bekerja ?? '') == 'wirausaha' ? 'selected' : '' }}>Wirausaha</option>
                    <option value="tidak" {{ old('bekerja', $tracer->bekerja ?? '') == 'tidak' ? 'selected' : '' }}>Belum/Tidak Bekerja</option>
                </select>
            </div>

            <div id="infoPekerjaan" style="display: {{ (old('bekerja', $tracer->bekerja ?? '') == 'ya') ? 'block' : 'none' }};">
                <div class="section-title"><i class="fas fa-building me-2"></i>Informasi Pekerjaan</div>
                <div class="mb-3">
                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                        <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $tracer->nama_perusahaan ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                        <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $tracer->jabatan ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat_pekerjaan" class="form-label">Alamat Perusahaan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                        <input type="text" name="alamat_pekerjaan" class="form-control" value="{{ old('alamat_pekerjaan', $tracer->alamat_pekerjaan ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="gaji" class="form-label">Gaji atau Pendapatan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="gaji" class="form-control" value="{{ old('gaji', $tracer->gaji ?? '') }}">
                    </div>
                </div>
            </div>

            <div id="infoWirausaha" style="display: {{ (old('bekerja', $tracer->bekerja ?? '') == 'wirausaha') ? 'block' : 'none' }};">
                <div class="section-title"><i class="fas fa-lightbulb me-2"></i>Informasi Wirausaha</div>
                <div class="mb-3">
                    <label for="nama_usaha" class="form-label">Nama Usaha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-store"></i></span>
                        <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $tracer->nama_usaha ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="posisi_usaha" class="form-label">Posisi Anda dalam Usaha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-chart-line"></i></span>
                        <input type="text" name="posisi_usaha" class="form-control" value="{{ old('posisi_usaha', $tracer->posisi_usaha ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tingkat_usaha" class="form-label">Skala Usaha (contoh: Lokal/Nasional)</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                        <input type="text" name="tingkat_usaha" class="form-control" value="{{ old('tingkat_usaha', $tracer->tingkat_usaha ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="alamat_usaha" class="form-label">Alamat Usaha</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                        <input type="text" name="alamat_usaha" class="form-control" value="{{ old('alamat_usaha', $tracer->alamat_usaha ?? '') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pendapatan_usaha" class="form-label">Pendapatan Usaha Per Bulan (contoh: 3.000.000)</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" name="pendapatan_usaha" class="form-control" value="{{ old('pendapatan_usaha', $tracer->pendapatan_usaha ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="section-title"><i class="fas fa-cogs me-2"></i>Kompetensi yang Dimiliki</div>
            <div class="mb-3">
                <label for="etika" class="form-label">Etika</label>
                <select name="etika" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('etika', $tracer->etika ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('etika', $tracer->etika ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('etika', $tracer->etika ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('etika', $tracer->etika ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="keahlian" class="form-label">Keahlian di Bidang Ilmu</label>
                <select name="keahlian" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('keahlian', $tracer->keahlian ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('keahlian', $tracer->keahlian ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('keahlian', $tracer->keahlian ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('keahlian', $tracer->keahlian ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="penggunaanteknologi" class="form-label">Penggunaan Teknologi Informasi</label>
                <select name="penggunaanteknologi" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('penggunaanteknologi', $tracer->penggunaanteknologi ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('penggunaanteknologi', $tracer->penggunaanteknologi ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('penggunaanteknologi', $tracer->penggunaanteknologi ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('penggunaanteknologi', $tracer->penggunaanteknologi ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="teamwork" class="form-label">Kemampuan Kerja Sama Tim</label>
                <select name="teamwork" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('teamwork', $tracer->teamwork ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('teamwork', $tracer->teamwork ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('teamwork', $tracer->teamwork ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('teamwork', $tracer->teamwork ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="komunikasi" class="form-label">Kemampuan Komunikasi</label>
                <select name="komunikasi" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('komunikasi', $tracer->komunikasi ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('komunikasi', $tracer->komunikasi ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('komunikasi', $tracer->komunikasi ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('komunikasi', $tracer->komunikasi ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="pengembangan" class="form-label">Kemampuan Pengembangan Diri</label>
                <select name="pengembangan" class="form-select" required>
                    <option value="">Pilih Skala</option>
                    <option value="Sangat Baik" {{ old('pengembangan', $tracer->pengembangan ?? '') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ old('pengembangan', $tracer->pengembangan ?? '') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ old('pengembangan', $tracer->pengembangan ?? '') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Kurang" {{ old('pengembangan', $tracer->pengembangan ?? '') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="section-title"><i class="fas fa-comments me-2"></i>Evaluasi dan Saran</div>
            <div class="mb-3">
                <label for="relevansi_kurikulum" class="form-label">Relevansi Kurikulum dengan Pekerjaan/Usaha</label>
                <select name="relevansi_kurikulum" class="form-select" required>
                    <option value="">Pilih Skala Relevansi</option>
                    <option value="Sangat Relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'Sangat Relevan' ? 'selected' : '' }}>Sangat Relevan</option>
                    <option value="Relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'Relevan' ? 'selected' : '' }}>Relevan</option>
                    <option value="Cukup Relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'Cukup Relevan' ? 'selected' : '' }}>Cukup Relevan</option>
                    <option value="Kurang Relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'Kurang Relevan' ? 'selected' : '' }}>Kurang Relevan</option>
                    <option value="Tidak Relevan" {{ old('relevansi_kurikulum', $tracer->relevansi_pekerjaan ?? '') == 'Tidak Relevan' ? 'selected' : '' }}>Tidak Relevan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="saran" class="form-label">Saran untuk Institusi</label>
                <textarea name="saran" class="form-control" rows="4" placeholder="Berikan saran Anda untuk pengembangan institusi... ">{{ old('saran', $tracer->saran ?? '') }}</textarea>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn-submit"><i class="fas fa-save me-2"></i>Update Kuesioner</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
    <script src="{{ asset('assets/js/plugins/penggunatables/jquery.penggunaTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/penggunatables-bs5/js/penggunaTables.bootstrap5.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Function to toggle sections based on 'bekerja' status
            function toggleStatusSections() {
                const status = $('#bekerja').val();
                if (status === 'ya') {
                    $('#infoPekerjaan').slideDown();
                    $('#infoWirausaha').slideUp();
                } else if (status === 'wirausaha') {
                    $('#infoPekerjaan').slideUp();
                    $('#infoWirausaha').slideDown();
                } else {
                    $('#infoPekerjaan').slideUp();
                    $('#infoWirausaha').slideUp();
                }
            }

            // Initial call to set correct visibility on page load
            toggleStatusSections();

            // Bind change event to the 'bekerja' select element
            $('#bekerja').on('change', function() {
                toggleStatusSections();
            });

            // SweetAlert for success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000, // Close after 3 seconds
                    customClass: {
                        popup: 'alert-success-custom'
                    }
                });
            @endif
        });
    </script>
</body>
@endsection
