<!DOCTYPE html>
<html lang="id">
@extends('layout')

@section('content')
@include('components.navbar')

<body>
    <div id="container" class="main-content">
        <main id="main-container" class="container-fluid px-3 px-md-5 py-4">
            <!-- Header -->
            <div class="content mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">Detail Tracer Pengguna</h1>
                        <p class="text-muted mb-0">Menampilkan informasi detail tracer pengguna</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <a href="{{ route('tracer.kuesioner-pengguna.edit', $pengguna->id) }}" class="btn btn-primary d-flex align-items-center">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="row g-4">
                    <!-- Informasi Personal -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0 pb-0">
                                <h5 class="card-title mb-0 fw-semibold">Informasi Personal</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3">
                                    @foreach ([
                                        'Nama' => $pengguna->nama,
                                        'Program Studi' => $pengguna->prodi,
                                        'Alamat' => $pengguna->alamat,
                                        'Jabatan' => $pengguna->jabatan
                                    ] as $label => $value)
                                        <div class="col-12">
                                            <label class="form-label text-muted small">{{ $label }}</label>
                                            <p class="mb-0 fw-medium">{{ $value ?? '-' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Perusahaan -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-0 pb-0">
                                <h5 class="card-title mb-0 fw-semibold">Informasi Perusahaan</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-3">
                                    @foreach ([
                                        'Nama Perusahaan' => $pengguna->nama_perusahaan,
                                        'Alamat Perusahaan' => $pengguna->alamat_perusahaan,
                                        'Nama Atasan' => $pengguna->nama_atasan,
                                        'NIP Atasan' => $pengguna->nip_atasan,
                                        'Posisi Atasan' => $pengguna->posisi_jabatan_atasan
                                    ] as $label => $value)
                                        <div class="col-sm-6">
                                            <label class="form-label text-muted small">{{ $label }}</label>
                                            <p class="mb-0 fw-medium">{{ $value ?? '-' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian Kompetensi -->
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-0 pb-0">
                                <h5 class="card-title mb-0 fw-semibold">Penilaian Kompetensi</h5>
                            </div>
                            <div class="card-body pt-3">
                                <div class="row g-4">
                                    @php
                                        $konversiNilai = [
                                            'sangat_baik' => ['label' => 'Sangat Bagus', 'rating' => 5],
                                            'baik' => ['label' => 'Bagus', 'rating' => 4],
                                            'cukup' => ['label' => 'Cukup', 'rating' => 3],
                                            'kurang' => ['label' => 'Kurang', 'rating' => 2],
                                            'kurang_baik' => ['label' => 'Kurang Baik', 'rating' => 1],
                                        ];

                                        $kompetensiAll = [
                                            'Integritas' => $pengguna->integritas,
                                            'Keahlian Bidang Ilmu' => $pengguna->keahlian,
                                            'Kemampuan Etika' => $pengguna->kemampuan,
                                            'Penguasaan TIK' => $pengguna->penguasaan,
                                            'Komunikasi' => $pengguna->komunikasi,
                                            'Kerja Tim' => $pengguna->kerja_tim,
                                            'Pengembangan Diri' => $pengguna->pengembangan,
                                        ];
                                    @endphp

                                    @foreach ($kompetensiAll as $label => $value)
                                        @php
                                            $display = $konversiNilai[$value] ?? ['label' => '-', 'rating' => 0];
                                        @endphp
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="d-flex justify-content-between align-items-center py-2">
                                                <div>
                                                    <p class="mb-1 fw-medium">{{ $label }}</p>
                                                    <div class="d-flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="{{ $i <= $display['rating'] ? 'fas' : 'far' }} fa-star {{ $i <= $display['rating'] ? 'text-warning' : 'text-muted' }} me-1"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <span class="badge bg-light text-dark">{{ $display['label'] }} ({{ $display['rating'] }}/5)</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($pengguna->saran)
                        <!-- Saran & Komentar -->
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white border-0 pb-0">
                                    <h5 class="card-title mb-0 fw-semibold">Saran & Komentar</h5>
                                </div>
                                <div class="card-body pt-3">
                                    <p class="mb-0 text-muted fst-italic">"{{ $pengguna->saran }}"</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Info Timestamp -->
                    <div class="col-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body py-3 d-flex flex-column flex-md-row justify-content-between">
                                <small class="text-muted">Dibuat: {{ $pengguna->created_at->format('d F Y, H:i') }}</small>
                                <small class="text-muted">Diperbarui: {{ $pengguna->updated_at->format('d F Y, H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Custom CSS -->
    <style>
        .card {
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .fa-star {
            font-size: 14px;
        }

        .form-label {
            font-weight: 500;
        }

        .card-header {
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .card-body {
            padding: 1rem 1.5rem 1.5rem;
        }

        .shadow-sm {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
        }
    </style>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
    <script src="{{ asset('assets/js/plugins/penggunatables/jquery.penggunaTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/penggunatables-bs5/js/penggunaTables.bootstrap5.min.js') }}"></script>
</body>
@endsection

</html>
