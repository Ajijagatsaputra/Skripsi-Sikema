<!DOCTYPE html>
<html lang="id">
@extends('layout')

@section('content')
@include('components.navbar')

<main id="main-container" class="mt-3">
    <div class="content py-4">

        <!-- HEADER -->
        <div class="mb-4">
            <h1 class="h3 fw-bold text-dark mb-1">Detail Data Study</h1>
            <p class="text-muted mb-3">Menampilkan informasi detail data study</p>
            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali</a>
                <a href="{{ route('tracer.kuesioner') }}" class="btn btn-primary">Edit</a>
            </div>
        </div>

        <div class="row g-4">

            <!-- INFORMASI PERSONAL -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Informasi Personal</h5>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="small text-muted">Nama Lengkap</div>
                            <div class="fw-medium">{{ $tracer->alumni->nama_lengkap ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Program Studi</div>
                            <div class="fw-medium">{{ $tracer->alumni->prodi ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Alamat Alumni</div>
                            <div class="fw-medium">{{ $tracer->alumni->alamat ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Tanggal Pengisian</div>
                            <div class="fw-medium">{{ $tracer->tanggal_isi?->format('d F Y') ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- INFORMASI PEKERJAAN ATAU WIRAUSAHA -->
            @if ($tracer->bekerja === 'ya')
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Informasi Pekerjaan</h5>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="small text-muted">Status Bekerja</div>
                            <div class="fw-medium">Bekerja</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Nama Perusahaan</div>
                            <div class="fw-medium">{{ $tracer->nama_perusahaan ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Jabatan</div>
                            <div class="fw-medium">{{ $tracer->jabatan ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Alamat Tempat Kerja</div>
                            <div class="fw-medium">{{ $tracer->alamat_pekerjaan ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Relevansi Pekerjaan</div>
                            <div class="fw-medium">{{ $tracer->relevansi_pekerjaan ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Gaji</div>
                            <div class="fw-medium">
                                {{ $tracer->gaji ? 'Rp' . number_format($tracer->gaji, 0, ',', '.') : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif ($tracer->bekerja === 'wirausaha')
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Informasi Wirausaha</h5>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        <div class="col">
                            <div class="small text-muted">Status</div>
                            <div class="fw-medium">Wirausaha</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Nama Usaha</div>
                            <div class="fw-medium">{{ $tracer->nama_usaha ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Posisi</div>
                            <div class="fw-medium">{{ $tracer->posisi_usaha ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Pendapatan Usaha</div>
                            <div class="fw-medium">{{ $tracer->pendapatan_usaha ?? '-' }}</div>
                        </div>
                        <div class="col">
                            <div class="small text-muted">Alamat Usaha</div>
                            <div class="fw-medium">{{ $tracer->alamat_usaha ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Status</h5>
                    <div class="fw-medium">Tidak Bekerja / Tidak Wirausaha</div>
                </div>
            </div>
            @endif

            <!-- SARAN & KOMENTAR -->
            @if ($tracer->saran)
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3 text-end">Saran atau Komentar</h5>
                    <blockquote class="blockquote text-muted fst-italic text-end">
                        "{{ $tracer->saran }}"
                    </blockquote>
                </div>
            </div>
            @endif

            <!-- INFO TIMESTAMP -->
            <div class="col-12">
                <div class="card border-0 bg-light">
                    <div class="card-body py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Dibuat: {{ $tracer->created_at->format('d F Y, H:i') }}
                            </small>
                            <small class="text-muted">
                                Diperbarui: {{ $tracer->updated_at->format('d F Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .card {
            transition: all 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .card-body {
            padding: 1rem 1.5rem 1.5rem;
        }

        .text-muted {
            font-size: 0.875rem;
        }

        .fw-medium {
            font-weight: 500;
            font-size: 1rem;
        }
    </style>

    <!-- JS & Styles -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
    <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
</main>
@endsection
</html>
