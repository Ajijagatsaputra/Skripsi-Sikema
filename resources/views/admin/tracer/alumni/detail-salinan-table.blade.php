@extends('layouts.admin')

@section('content')
    <div class="content py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1">Detail Data Tracer Alumni</h1>
                <p class="text-muted mb-0">Menampilkan informasi detail tracer study alumni</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('listtracerpengguna.index') }}" class="btn btn-outline-secondary">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Informasi Personal -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="card-title mb-0 fw-semibold">Informasi Personal</h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Nama</label>
                                    <p class="mb-0 fw-medium">{{ $data->nama ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Program Studi</label>
                                    <p class="mb-0 fw-medium">{{ $data->prodi ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Alamat</label>
                                    <p class="mb-0 fw-medium">{{ $data->alamat ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-0">
                                    <label class="form-label text-muted small">Jabatan</label>
                                    <p class="mb-0 fw-medium">{{ $data->jabatan ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Perusahaan -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="card-title mb-0 fw-semibold">Informasi Perusahaan</h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Nama Perusahaan</label>
                                    <p class="mb-0 fw-medium">{{ $data->nama_perusahaan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Alamat Perusahaan</label>
                                    <p class="mb-0 fw-medium">{{ $data->alamat_perusahaan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">Nama Atasan</label>
                                    <p class="mb-0 fw-medium">{{ $data->nama_atasan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label text-muted small">NIP Atasan</label>
                                    <p class="mb-0 fw-medium">{{ $data->nip_atasan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-0">
                                    <label class="form-label text-muted small">Posisi Atasan</label>
                                    <p class="mb-0 fw-medium">{{ $data->posisi_jabatan_atasan ?? '-' }}</p>
                                </div>
                            </div>
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
                                    'Integritas' => $data->integritas,
                                    'Keahlian Bidang Ilmu' => $data->keahlian,
                                    'Kemampuan Etika' => $data->kemampuan,
                                    'Penguasaan TIK' => $data->penguasaan,
                                    'Komunikasi' => $data->komunikasi,
                                    'Kerja Tim' => $data->kerja_tim,
                                    'Pengembangan Diri' => $data->pengembangan,
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
                                                    @if ($i <= $display['rating'])
                                                        <i class="fas fa-star text-warning me-1"></i>
                                                    @else
                                                        <i class="far fa-star text-muted me-1"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge bg-light text-dark">{{ $display['label'] }}
                                                ({{ $display['rating'] }}/5)</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if ($data->saran)
                <!-- Saran & Komentar -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 pb-0">
                            <h5 class="card-title mb-0 fw-semibold">Saran & Komentar</h5>
                        </div>
                        <div class="card-body pt-3">
                            <p class="mb-0 text-muted fst-italic">"{{ $data->saran }}"</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Info Timestamp -->
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Dibuat: {{ $data->created_at->format('d F Y, H:i') }}
                            </small>
                            <small class="text-muted">
                                Diperbarui: {{ $data->updated_at->format('d F Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    </div>


    <style>
        .card {
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-1px);
        }

        .fa-star {
            font-size: 14px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.25rem;
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
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
@endsection
