@extends('layout')

@section('content')
    @include('components.navbar')

    <!-- Panggil CSS di Folder Public -->
    <link rel="stylesheet" href="{{ asset('css/kuesioner-tracer-pengguna.css') }}">

    <div class="container-lg mt-5 mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4 mx-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="questionnaire-container">
            <!-- Header -->
            <div class="header-section">
                <i class="fas fa-graduation-cap fa-3x mb-3"></i>
                <h1>Tracer Study Pengguna Alumni Tahun 2025</h1>
                <h2 style="font-size: 1.8rem; font-weight: 600; margin: 0.5rem 0;">Politeknik Harapan Bersama</h2>
                <p>Kuesioner untuk mengetahui perkembangan karir dan evaluasi pendidikan alumni</p>
            </div>

            <div class="p-4 p-md-5">
                <form id="alumniForm" action="{{ route('tracer.store') }}" method="POST">
                    @csrf

                    {{-- SECTION: Informasi Pribadi --}}
                    <div class="section-card mb-4">
                        <div class="section-header">
                            <i class="fas fa-user me-2"></i>Informasi Pribadi
                        </div>
                        <div class="p-4 row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Alumni</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ $alumni->nama_lengkap ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat Alumni</label>
                                <input type="text" name="alamat" class="form-control"
                                    value="{{ $alumni->alamat ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="fas fa-book text-primary"></i> Program Studi
                                </label>
                                <input type="text" name="prodi" value="Teknik Informatika" class="form-control"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Posisi/Jabatan Pekerjaan</label>
                                <input type="text" name="jabatan" class="form-control"
                                    value="{{ $tracer->jabatan ?? '' }}" required>
                            </div>
                        </div>
                    </div>

                    {{-- SECTION: Kompetensi Lulusan --}}
                    <div class="section-card mb-4">
                        <div class="section-header">
                            <i class="fas fa-star me-2"></i>Survey Kompetensi Lulusan
                        </div>
                        <div class="p-4 row g-4">
                            @foreach (['integritas', 'keahlian', 'kemampuan', 'penguasaan', 'komunikasi', 'kerja_tim', 'pengembangan'] as $kompetensi)
                                <div class="col-md-6">
                                    <label class="form-label text-capitalize">{{ ucfirst($kompetensi) }}</label>
                                    <select name="{{ $kompetensi }}" class="form-select" required>
                                        <option disabled selected>-- Pilih Level --</option>
                                        <option value="sangat_baik">Sangat Baik</option>
                                        <option value="baik">Baik</option>
                                        <option value="cukup">Cukup</option>
                                        <option value="kurang_baik">Kurang Baik</option>
                                        <option value="tidak_baik">Tidak Baik</option>
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- SECTION: Penilaian Atasan --}}
                    <div class="section-card mb-4">
                        <div class="section-header">
                            <i class="fas fa-user-tie me-2"></i>Penilaian Oleh Atasan Pengguna Lulusan
                        </div>
                        <div class="p-4 row g-4">
                            <div class="col-md-6"><label class="form-label">Nama Lengkap Atasan / Pengguna
                                    Lulusan</label><input type="text" name="nama_atasan" class="form-control" required>
                            </div>
                            <div class="col-md-6"><label class="form-label">NIP/NIPY/NIK</label><input type="text"
                                    name="nip_atasan" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Posisi/Jabatan Atasan di
                                    Perusahaan</label><input type="text" name="posisi_jabatan_atasan"
                                    class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Nama Perusahaan</label><input type="text"
                                    name="nama_perusahaan" class="form-control" required></div>
                            <div class="col-md-12"><label class="form-label">Alamat Perusahaan</label><input type="text"
                                    name="alamat_perusahaan" class="form-control" required></div>
                        </div>
                    </div>

                    {{-- SECTION: Saran --}}
                    <div class="section-card mb-4">
                        <div class="section-header">
                            <i class="fas fa-comments me-2"></i>Saran dan Masukan
                        </div>
                        <div class="p-4">
                            <label class="form-label">Berikan saran/kritik untuk perbaikan kampus</label>
                            <textarea name="saran" class="form-control" rows="5" placeholder="Tulis saran atau kritik Anda..."></textarea>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Kuesioner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
@endsection
