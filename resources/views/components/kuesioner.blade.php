@extends('layout')

@section('content')
    <main class="main">
        @include('components.navbar')

        <!-- Panggil CSS di FolderPublic -->
        <link rel="stylesheet" href="{{ asset('css/kuesioner-tracer-study.css') }}">

        <body>
            @if ($errors->has('error'))
                <div class="container">
                    <div class="alert alert-danger mt-3 animate-fade-in">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ $errors->first('error') }}
                    </div>
                </div>
            @endif

            <div class="container mt-2">
                <div class="questionnaire-container animate-fade-in">
                    <!-- Header -->
                    <div class="header-section">
                        <i class="fas fa-graduation-cap"></i>
                        <h1>Tracer Study Alumni Tahun 2025</h1>
                        <h2 style="font-size: 1.8rem; font-weight: 600; margin: 0.5rem 0;">Politeknik Harapan Bersama</h2>
                        <p>Kuesioner untuk mengetahui perkembangan karir dan evaluasi pendidikan alumni</p>
                    </div>

                    <div class="p-4">
                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-semibold">Progress Pengisian</small>
                                <small class="text-primary fw-bold"><span id="progressText">0%</span></small>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 0%"
                                    id="progressBar"></div>
                            </div>
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
                                                placeholder="Masukkan nama lengkap"
                                                value="{{ $alumni->nama_lengkap ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-phone text-primary"></i>
                                                Nomor HP/Whatsapp
                                            </label>
                                            <input type="text" name="no_hp" class="form-control"
                                                value="{{ $alumni->no_hp ?? '' }}" placeholder="+62812xxxxxxxx" required>
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
                                        <div class="col-md-12">
                                            <label class="form-label">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                                Alamat Lengkap
                                            </label>
                                            <textarea name="alamat" class="form-control" rows="3" placeholder="Desa, Kecamatan, Kabupaten, Provinsi"
                                                required>{{ $alumni->alamat ?? '' }}</textarea>
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
                                                <i class="fas fa-briefcase text-success"></i>
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
                                        <div class="col-md-12">
                                            <label class="form-label">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                                Alamat Tempat Usaha
                                            </label>
                                            <textarea name="alamat_usaha" class="form-control" rows="3" placeholder="Alamat lengkap usaha"></textarea>
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
                                                placeholder="5000000">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kompetensi -->
                            <div class="section-card animate-fade-in">
                                <div class="section-header">
                                    <i class="fas fa-star"></i>
                                    Penilaian Kompetensi Saat Lulus
                                </div>
                                <div class="section-body">
                                    <div class="alert"
                                        style="background: linear-gradient(135deg, rgba(6, 182, 212, 0.1), rgba(6, 182, 212, 0.05)); border-left: 4px solid var(--accent-color); color: var(--accent-color);">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Bandingkan kompetensi Anda pada saat <strong>LULUS</strong> (yang dikuasai ketika
                                        baru lulus)
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-heart text-primary"></i>
                                                Etika
                                            </label>
                                            <select name="etika" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-tools text-primary"></i>
                                                Keahlian
                                            </label>
                                            <select name="keahlian" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-laptop text-primary"></i>
                                                Penggunaan Teknologi
                                            </label>
                                            <select name="penggunaanteknologi" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-users text-primary"></i>
                                                Kerja Sama Tim
                                            </label>
                                            <select name="teamwork" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-comments text-primary"></i>
                                                Komunikasi
                                            </label>
                                            <select name="komunikasi" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-chart-line text-primary"></i>
                                                Pengembangan Skills
                                            </label>
                                            <select name="pengembangan" class="form-select" required>
                                                <option value="" disabled selected>-- Pilih Level --</option>
                                                <option value="sangat_baik">⭐⭐⭐⭐⭐ Sangat Baik</option>
                                                <option value="baik">⭐⭐⭐⭐ Baik</option>
                                                <option value="cukup">⭐⭐⭐ Cukup</option>
                                                <option value="kurang_baik">⭐⭐ Kurang Baik</option>
                                                <option value="tidak_baik">⭐ Tidak Baik</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Evaluasi Pendidikan -->
                            <div class="section-card animate-fade-in">
                                <div class="section-header">
                                    <i class="fas fa-graduation-cap"></i>
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
                                    <i class="fas fa-lightbulb"></i>
                                    Saran dan Masukan
                                </div>
                                <div class="section-body">
                                    <label class="form-label mb-3">
                                        <i class="fas fa-edit text-primary"></i>
                                        Berikan saran atau kritik untuk perbaikan kurikulum dan fasilitas kampus
                                    </label>
                                    <textarea name="saran" rows="5" class="form-control"
                                        placeholder="💡 Tulis saran, kritik, atau masukan Anda di sini untuk membantu kampus menjadi lebih baik..."></textarea>
                                </div>
                            </div>

                            <!-- Tombol Kirim -->
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    Kirim Kuesioner
                                </button>
                                <div class="mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-lock me-1"></i>
                                        Data Anda akan dijaga kerahasiaannya dan digunakan untuk pengembangan kampus
                                    </small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Floating Action Button untuk kembali ke atas -->
            <button id="backToTop" class="btn"
                style="
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            box-shadow: var(--shadow-lg);
            display: none;
            z-index: 1000;
            transition: all 0.3s ease;
        "
                onclick="scrollToTop()">
                <i class="fas fa-arrow-up"></i>
            </button>

            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
            <script>
                // Progress tracking dengan animasi yang lebih smooth
                function updateProgress() {
                    const form = document.getElementById('alumniForm');
                    const requiredInputs = form.querySelectorAll('input[required], select[required], textarea[required]');
                    const visibleRequiredInputs = Array.from(requiredInputs).filter(input => {
                        const section = input.closest('.section-card');
                        return !section || section.style.display !== 'none';
                    });

                    let filledInputs = 0;

                    visibleRequiredInputs.forEach(input => {
                        if (input.type === 'radio') {
                            const radioGroup = form.querySelector(`input[name="${input.name}"]:checked`);
                            if (radioGroup && visibleRequiredInputs.includes(input)) {
                                filledInputs++;
                            }
                        } else if (input.value.trim() !== '') {
                            filledInputs++;
                        }
                    });

                    const progress = visibleRequiredInputs.length > 0 ? (filledInputs / visibleRequiredInputs.length) * 100 : 0;

                    // Animasi progress bar
                    const progressBar = document.getElementById('progressBar');
                    const progressText = document.getElementById('progressText');

                    progressBar.style.width = progress + '%';
                    progressText.textContent = Math.round(progress) + '%';

                    // Ubah warna progress berdasarkan persentase
                    if (progress < 33) {
                        progressBar.style.background = 'linear-gradient(90deg, #ef4444, #f97316)';
                    } else if (progress < 66) {
                        progressBar.style.background = 'linear-gradient(90deg, #f59e0b, #eab308)';
                    } else {
                        progressBar.style.background = 'linear-gradient(90deg, #06b6d4, #10b981)';
                    }
                }

                // Show/hide sections berdasarkan status pekerjaan
                document.querySelectorAll('input[name="bekerja"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const detailPekerjaan = document.getElementById('detailPekerjaan');
                        const detailWirausaha = document.getElementById('detailWirausaha');

                        // Hide semua section terlebih dahulu
                        detailPekerjaan.style.display = 'none';
                        detailWirausaha.style.display = 'none';

                        // Clear required attributes
                        detailPekerjaan.querySelectorAll('input, select').forEach(el => {
                            el.removeAttribute('required');
                            el.value = '';
                        });
                        detailWirausaha.querySelectorAll('input, select').forEach(el => {
                            el.removeAttribute('required');
                            el.value = '';
                        });

                        // Show section yang relevan
                        if (this.value === 'ya') {
                            setTimeout(() => {
                                detailPekerjaan.style.display = 'block';
                                detailPekerjaan.querySelectorAll('input, select').forEach(el => {
                                    if (el.name === 'nama_perusahaan' || el.name === 'jabatan') {
                                        el.setAttribute('required', 'required');
                                    }
                                });
                                detailPekerjaan.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest'
                                });
                            }, 100);
                        } else if (this.value === 'wirausaha') {
                            setTimeout(() => {
                                detailWirausaha.style.display = 'block';
                                detailWirausaha.querySelectorAll('input, select').forEach(el => {
                                    if (el.name === 'nama_usaha' || el.name === 'posisi_usaha') {
                                        el.setAttribute('required', 'required');
                                    }
                                });
                                detailWirausaha.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'nearest'
                                });
                            }, 100);
                        }

                        updateProgress();
                    });
                });

                // Update progress saat input berubah
                document.addEventListener('input', updateProgress);
                document.addEventListener('change', updateProgress);

                // Floating back to top button
                window.addEventListener('scroll', function() {
                    const backToTop = document.getElementById('backToTop');
                    if (window.pageYOffset > 300) {
                        backToTop.style.display = 'block';
                    } else {
                        backToTop.style.display = 'none';
                    }
                });

                function scrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }

                // Form submission dengan loading state
                document.getElementById('alumniForm').addEventListener('submit', function(e) {
                    const submitBtn = document.querySelector('.btn-submit');
                    const originalText = submitBtn.innerHTML;

                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
                    submitBtn.disabled = true;

                    // Jika ada error, kembalikan button ke state semula
                    setTimeout(() => {
                        if (submitBtn.disabled) {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }
                    }, 10000);
                });

                // Animasi fade in untuk section cards
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, observerOptions);

                // Observe semua section cards
                document.querySelectorAll('.section-card').forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                    observer.observe(card);
                });

                // Initialize progress
                updateProgress();

                // Konfirmasi sebelum meninggalkan halaman jika form sudah diisi
                let formChanged = false;
                document.addEventListener('input', () => formChanged = true);
                document.addEventListener('change', () => formChanged = true);

                window.addEventListener('beforeunload', function(e) {
                    if (formChanged) {
                        e.preventDefault();
                        e.returnValue = '';
                    }
                });

                // Remove konfirmasi saat form di-submit
                document.getElementById('alumniForm').addEventListener('submit', function() {
                    formChanged = false;
                });

                // Auto-save ke localStorage setiap 30 detik (opsional)
                setInterval(function() {
                    if (formChanged) {
                        const formData = new FormData(document.getElementById('alumniForm'));
                        const data = {};
                        for (let [key, value] of formData.entries()) {
                            data[key] = value;
                        }
                        // Note: localStorage tidak tersedia di Claude artifacts
                        // localStorage.setItem('tracer_study_draft', JSON.stringify(data));
                    }
                }, 30000);
            </script>

        </body>
    </main>
@endsection
