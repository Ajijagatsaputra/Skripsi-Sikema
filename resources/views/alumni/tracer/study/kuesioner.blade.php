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
                                                Alamat Email
                                            </label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $alumni->users->email ?? (auth()->user()->email ?? '')) }}"
                                                placeholder="contoh@email.com" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-graduation-cap text-primary"></i>
                                                Tahun Lulus
                                            </label>
                                            <input type="number" name="tahun_lulus" class="form-control"
                                                value="{{ $alumni->tahun_lulus ?? '' }}" placeholder="2023" min="2000"
                                                max="2030" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-id-card text-primary"></i>
                                                NIM
                                            </label>
                                            <input type="number" name="nim" class="form-control"
                                                value="{{ old('nim', $alumni->nim ?? (auth()->user()->nim ?? '')) }}"
                                                placeholder="20210001" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">
                                                <i class="fas fa-book text-primary"></i> Program Studi
                                            </label>
                                            <input type="text" name="prodi" value="Teknik Informatika"
                                                class="form-control" readonly>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                                Alamat Lengkap
                                            </label>
                                            <textarea name="alamat" class="form-control" rows="3"
                                                placeholder="Desa Pengabean RT. 008/003 Kec. Margadana, Kota Tegal" required>{{ $alumni->alamat ?? '' }}</textarea>
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
                                        Jelaskan status anda saat ini?
                                    </label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" name="bekerja" value="bekerja_full" id="bekerja_full"
                                                class="form-check-input" required>
                                            <label for="bekerja_full" class="form-check-label">
                                                <i class="fas fa-briefcase text-success"></i>
                                                Bekerja (full time / part time)
                                            </label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="bekerja" value="belum_bekerja"
                                                id="belum_bekerja" class="form-check-input" required>
                                            <label for="belum_bekerja" class="form-check-label">
                                                <i class="fas fa-clock"></i>
                                                Belum memungkinkan bekerja
                                            </label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="bekerja" value="wirausaha"
                                                id="bekerja_wirausaha" class="form-check-input">
                                            <label for="bekerja_wirausaha" class="form-check-label">
                                                <i class="fas fa-store text-warning"></i>
                                                Wiraswasta
                                            </label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="bekerja" value="lanjutstudy"
                                                id="bekerja_lanjutstudy" class="form-check-input">
                                            <label for="bekerja_lanjutstudy" class="form-check-label">
                                                <i class="fas fa-graduation-cap"></i>
                                                Melanjutkan Pendidikan
                                            </label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" name="bekerja" value="tidak" id="bekerja_tidak"
                                                class="form-check-input">
                                            <label for="bekerja_tidak" class="form-check-label">
                                                <i class="fas fa-search text-danger"></i>
                                                Tidak kerja, tetapi sedang mencari kerja
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('components.form-alumni.bagian6')
                            @include('components.form-alumni.bagian2-3-4')
                            @include('components.form-alumni.bagian5')


                            <!-- Kesesuaian berkerja bagian 8 -->
                            @include('components.form-alumni.bagian8')

                            <!-- Kompetensi Point Alumni bagian 9-->
                            @include('components.form-alumni.bagian9')

                            <!-- Cara Mendapatkan Pekerjaan bagian 10-11-12-->
                            @include('components.form-alumni.bagian10-11-12')
                    </div>

                    <!-- Detail LanjutStudy bagian 7-->
                    @include('components.form-alumni.bagian7')


                    {{-- <!-- Kompetensi Point Alumni bagian 9-->
                    @include('components.form-alumni.bagian9') --}}

                    <!-- Bagaimana anda mencari pekerjaan bagian 13-->
                    @include('components.form-alumni.bagian13')

                    <!-- Bagaimana anda mencari pekerjaan bagian 14-->
                    @include('components.form-alumni.bagian14')




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
            <script src="{{ asset('js/script-kuesioner-alumni.js') }}"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const select = document.getElementById('mendapatkanPekerjaan');
                    const detailKurang6 = document.getElementById('detailKurang6Bulan');
                    const detailLebih6 = document.getElementById('detailLebih6Bulan');

                    function toggleDetail() {
                        const selectedValue = select.value;

                        // Reset
                        detailKurang6.style.display = 'none';
                        detailLebih6.style.display = 'none';

                        // Tampilkan bagian sesuai pilihan
                        if (selectedValue === '<=6bulan') {
                            detailKurang6.style.display = 'flex';
                        } else if (selectedValue === '>6bulan') {
                            detailLebih6.style.display = 'flex';
                        }
                    }

                    select.addEventListener('change', toggleDetail);

                    // Cek jika ada nilai sebelumnya (untuk edit form)
                    toggleDetail();
                });
            </script>

        </body>
    </main>
@endsection
