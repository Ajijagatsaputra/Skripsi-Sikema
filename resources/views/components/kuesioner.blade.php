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

        .header-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 20"><defs><radialGradient id="a" cx="50%" cy="0%" r="50%"><stop offset="0%" stop-color="white" stop-opacity="0.1"/><stop offset="100%" stop-color="white" stop-opacity="0"/></radialGradient></defs><rect width="100" height="20" fill="url(%23a)"/></svg>');
            opacity: 0.3;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .header-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .section-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .section-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .section-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px 25px;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-body {
            padding: 30px 25px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control,
        .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
            transform: translateY(-2px);
        }

        .form-check-input {
            margin-top: 0.125rem;
            transform: scale(1.2);
        }

        .form-check-label {
            font-weight: 500;
            color: #495057;
            margin-left: 8px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #132ad6 0%, #1f12ce 100%);
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white !important;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(220, 222, 233, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #4563eb 0%, #667eea 100%);
            color: white !important;
        }

        .btn-submit:focus,
        .btn-submit:active {
            color: white !important;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .radio-option {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .radio-option:hover {
            border-color: #4facfe;
            background: rgba(79, 172, 254, 0.1);
        }

        .radio-option input:checked+label {
            color: #4facfe;
            font-weight: 600;
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .progress-bar-custom {
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            height: 6px;
            border-radius: 3px;
        }
    </style>
</head>
@extends('layout')

@section('content')
    @include('components.navbar')

    <body>
        @if ($errors->has('error'))
            <div class="alert alert-danger mt-3">
                {{ $errors->first('error') }}
            </div>
        @endif

        <div class="container mt-2">
            <div class="questionnaire-container animate-fade-in">
                <!-- Header -->
                <div class="header-section">
                    <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                    <h1>Tracer Study Tahun 2025 Politeknik Harapan Bersama</h1>
                    <p>Kuesioner untuk mengetahui perkembangan karir dan evaluasi pendidikan alumni</p>
                </div>

                <div class="p-4">
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="progress" style="height: 6px; border-radius: 3px;">
                            <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 0%"
                                id="progressBar"></div>
                        </div>
                        <small class="text-muted">Progress: <span id="progressText">0%</span></small>
                    </div>

                    <form id="alumniForm" action="{{ route('tracer.create') }}" method="POST">
                        @csrf
                        <!-- Informasi Pribadi -->
                        <div class="section-card animate-fade-in">
                            <div class="section-header">
                                <i class="fas fa-user"></i>
                                Informasi Pribadi
                            </div>
                            <div class="section-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-id-card text-primary"></i>
                                            Nama Lengkap
                                        </label>
                                        <input type="text" name="nama" class="form-control"
                                            placeholder="Masukkan nama lengkap" value="{{ $alumni->nama_lengkap ?? '' }}"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-phone text-primary"></i>
                                            Nomor HP/Whatsapp
                                        </label>
                                        <input type="text" name="no_hp" class="form-control"
                                            value="{{ $alumni->no_hp ?? '' }}" placeholder="+62" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-envelope text-primary"></i>
                                            Email
                                        </label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $alumni->users->email ?? (auth()->user()->email ?? '')) }}"
                                            placeholder="contoh@email.com" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-calendar text-primary"></i>
                                            Tahun Lulus
                                        </label>
                                        <input type="number" name="tahun_lulus" class="form-control"
                                            value="{{ $alumni->tahun_lulus ?? '' }}" placeholder="2023" min="2000"
                                            max="2024" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt text-primary"></i> Alamat Lengkap
                                        </label>
                                        <input type="alamat" name="alamat" class="form-control"
                                            value="{{ $alumni->alamat ?? '' }}" placeholder="Desa, Kecamatan, Kabupaten"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Pekerjaan -->
                        <div class="section-card animate-fade-in">
                            <div class="section-header">
                                <i class="fas fa-briefcase"></i>
                                Status Pekerjaan
                            </div>
                            <div class="section-body">
                                <label class="form-label mb-3">
                                    <i class="fas fa-question-circle text-primary"></i>
                                    Apakah Anda saat ini sedang bekerja?
                                </label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" name="bekerja" value="ya" id="bekerja_ya"
                                            class="form-check-input" required>
                                        <label for="bekerja_ya" class="form-check-label">
                                            <i class="fas fa-check-circle text-success"></i>
                                            Ya, saya bekerja
                                        </label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="bekerja" value="wirausaha" id="bekerja_wirausaha"
                                            class="form-check-input">
                                        <label for="bekerja_wirausaha" class="form-check-label">
                                            <i class="fas fa-store text-warning"></i>
                                            Wirausaha
                                        </label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" name="bekerja" value="tidak" id="bekerja_tidak"
                                            class="form-check-input">
                                        <label for="bekerja_tidak" class="form-check-label">
                                            <i class="fas fa-times-circle text-danger"></i>
                                            Tidak bekerja
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Wirausaha -->
                        <div class="section-card animate-fade-in" id="detailWirausaha" style="display: none;">
                            <div class="section-header">
                                <i class="fas fa-store"></i>
                                Detail Wirausaha
                            </div>
                            <div class="section-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-building text-primary"></i>
                                            Nama Usaha
                                        </label>
                                        <input type="text" name="nama_usaha" class="form-control"
                                            placeholder="Contoh: Warung Kopi Digital">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-user-tie text-primary"></i>
                                            Posisi/Jabatan
                                        </label>
                                        <select name="posisi_usaha" class="form-select">
                                            <option value="" disabled selected>-- Pilih posisi --</option>
                                            <option value="founder">Founder</option>
                                            <option value="co-founder">Co-Founder</option>
                                            <option value="staff">Staff</option>
                                            <option value="freelance">Freelance</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-globe text-primary"></i>
                                            Tingkat Tempat Usaha
                                        </label>
                                        <select name="tingkat_usaha" class="form-select">
                                            <option value="" disabled selected>-- Pilih tingkat --</option>
                                            <option value="lokal">Lokal</option>
                                            <option value="nasional">Nasional</option>
                                            <option value="internasional">Internasional</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fa-solid fa-money-bill-wave text-primary"></i>
                                            Rata-rata Pendapatan
                                        </label>
                                        <select name="pendapatan_usaha" class="form-select">
                                            <option value="" disabled selected>-- Pilih pendapatan --</option>
                                            <option value="0-2000000">0 - 2 juta</option>
                                            <option value="2000001-4000000">> 2 - 4 juta</option>
                                            <option value="4000001-999999999">> 4 juta</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                            Alamat Tempat Usaha
                                        </label>
                                        <input type="text" name="alamat_usaha" class="form-control"
                                            placeholder="Alamat lengkap usaha">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Detail Pekerjaan -->
                        <div class="section-card animate-fade-in" id="detailPekerjaan" style="display: none;">
                            <div class="section-header">
                                <i class="fas fa-building"></i>
                                Detail Pekerjaan
                            </div>
                            <div class="section-body">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-building text-primary"></i>
                                            Nama Perusahaan
                                        </label>
                                        <input type="text" name="nama_perusahaan" class="form-control"
                                            placeholder="PT. Contoh Perusahaan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-user-tie text-primary"></i>
                                            Jabatan
                                        </label>
                                        <input type="text" name="jabatan" class="form-control"
                                            placeholder="Software Developer">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                            Lokasi Pekerjaan
                                        </label>
                                        <input type="text" name="alamat_pekerjaan" class="form-control"
                                            placeholder="Jakarta, Indonesia">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            <i class="fas fa-money-bill-wave text-primary"></i>
                                            Gaji Pertama
                                        </label>
                                        <input type="text" name="gaji" class="form-control"
                                            placeholder="Rp 5.000.000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-header">
                                <i class="fas fa-star"></i>
                                Bandingkan Kompetensi anda Pada SAAT LULUS (yang dikuasai ketika baru lulus)
                            </div>
                            <div class="section-body">
                                <label class="form-label">Penilaian Kompetensi</label>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Bahasa Inggris</label>
                                        <select name="etika" class="form-select" required>
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
                                        <label class="form-label">Penggunaan Teknologi</label>
                                        <select name="penggunaanteknologi" class="form-select" required>
                                            <option value="" disabled selected>-- Pilih Level --</option>
                                            <option value="sangat_baik">Sangat Baik</option>
                                            <option value="baik">Baik</option>
                                            <option value="cukup">Cukup</option>
                                            <option value="kurang_baik">Kurang Baik</option>
                                            <option value="tidak_baik">Tidak Baik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kerja Sama Tim</label>
                                        <select name="teamwork" class="form-select" required>
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
                                        <label class="form-label">Pengembangan Skils</label>
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

                        <!-- Evaluasi Pendidikan -->
                        <div class="section-card animate-fade-in">
                            <div class="section-header">
                                <i class="fas fa-star"></i>
                                Evaluasi Pendidikan
                            </div>
                            <div class="section-body">
                                <label class="form-label mb-3">
                                    <i class="fas fa-book text-primary"></i>
                                    Apakah kurikulum kampus relevan dengan pekerjaan Anda sekarang?
                                </label>
                                <select name="relevansi_kurikulum" class="form-select" required>
                                    <option value="" disabled selected>-- Pilih tingkat relevansi --</option>
                                    <option value="sangat_relevan">⭐⭐⭐⭐⭐ Sangat Relevan</option>
                                    <option value="relevan">⭐⭐⭐⭐ Relevan</option>
                                    <option value="cukup">⭐⭐⭐ Cukup Relevan</option>
                                    <option value="tidak_relevan">⭐⭐ Kurang Relevan</option>
                                    <option value="sangat_tidak_relevan">⭐ Tidak Relevan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Saran -->
                        <div class="section-card animate-fade-in">
                            <div class="section-header">
                                <i class="fas fa-comments"></i>
                                Saran dan Masukan
                            </div>
                            <div class="section-body">
                                <label class="form-label mb-3">
                                    <i class="fas fa-edit text-primary"></i>
                                    Berikan saran atau kritik untuk perbaikan kurikulum dan fasilitas kampus
                                </label>
                                <textarea name="saran" rows="5" class="form-control"
                                    placeholder="Tulis saran, kritik, atau masukan Anda di sini untuk membantu kampus menjadi lebih baik..."></textarea>
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
        <script>
            // Progress tracking
            function updateProgress() {
                const form = document.getElementById('alumniForm');
                const inputs = form.querySelectorAll('input[required], select[required]');
                const detailWirausaha = document.getElementById('detailWirausaha');
                let filledInputs = 0;

                inputs.forEach(input => {
                    if (input.type === 'radio') {
                        if (form.querySelector(`input[name="${input.name}"]:checked`)) {
                            filledInputs++;
                        }

                    } else if (input.value.trim() !== '') {
                        filledInputs++;
                    }
                });

                const progress = (filledInputs / inputs.length) * 100;
                document.getElementById('progressBar').style.width = progress + '%';
                document.getElementById('progressText').textContent = Math.round(progress) + '%';
            }

            // Show/hide job details based on employment status
            document.querySelectorAll('input[name="bekerja"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const detailPekerjaan = document.getElementById('detailPekerjaan');
                    const detailWirausaha = document.getElementById('detailWirausaha')
                    if (this.value === 'ya') {
                        detailPekerjaan.style.display = 'block';
                        detailWirausaha.style.display = 'none';
                        detailPekerjaan.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    } else if (this.value === 'wirausaha') {
                        detailWirausaha.style.display = 'block';
                        detailPekerjaan.style.display = 'none';
                        detailWirausaha.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest'
                        });
                    } else {
                        detailPekerjaan.style.display = 'none';
                        detailWirausaha.style.display = 'none';
                    }
                    updateProgress();
                });
            });

            // Update progress on input change
            document.addEventListener('input', updateProgress);
            document.addEventListener('change', updateProgress);

            // Form submission


            // Initialize progress
            updateProgress();
        </script>
    </body>
@endsection

</html>
