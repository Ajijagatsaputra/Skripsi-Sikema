@extends('layout')

@section('title', 'Profil Alumni')

@section('content')
@include('components.navbar')

    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">🧾 Data Diri Alumni</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <!-- Foto dan Status -->
                            <div class="col-md-3 text-center border-end">
                                <img src="{{ asset('assets/media/avatars/avatar10.jpg') }}"
                                     class="img-thumbnail rounded-circle mb-2"
                                     width="120" height="120" alt="Foto Alumni">
                                <div class="fw-semibold text-success small">{{ $alumni->status_mahasiswa }}</div>
                                <div class="text-muted small">{{ $tahunAjaran ?? '2024/2025 - Genap' }}</div>
                                <div class="text-muted small">Semester {{ $semester ?? '8' }}</div>
                            </div>

                            <!-- Data Alumni -->
                            <div class="col-md-9">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <p><strong>NIM</strong>: {{ $alumni->nim }}</p>
                                        <p><strong>Nama Lengkap</strong>: {{ $alumni->nama_lengkap }}</p>
                                        <p><strong>Prodi</strong>: {{ $alumni->prodi }}</p>
                                        <p><strong>Kelas</strong>: {{ $alumni->kelas }}</p>
                                        <p><strong>Jalur Masuk</strong>: {{ $alumni->jalur }}</p>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <p><strong>No. HP</strong>: {{ $alumni->no_hp }}</p>
                                        <p><strong>Alamat</strong>: {{ $alumni->alamat }}</p>
                                        <p><strong>Tahun Masuk</strong>: {{ $alumni->tahun_masuk }}</p>
                                        <p><strong>Tahun Lulus</strong>: {{ $alumni->tahun_lulus }}</p>
                                        <p><strong>Status Mahasiswa</strong>: {{ $alumni->status_mahasiswa }}</p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button class="btn btn-secondary btn-sm rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#editProfileModal">
                                        <i class="fas fa-edit me-1"></i> Edit Data Diri
                                    </button>
                                    <div class="text-muted small mt-2">
                                        Terakhir diperbarui: {{ $alumni->updated_at->format('d M Y H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.modal-edit-profile-alumni')

    <style>
        /* Pastikan content mengisi full height */
        .container-fluid {
            min-height: calc(100vh - 140px); /* Sesuaikan dengan tinggi navbar + footer */
        }

        /* Responsive fixes */
        @media (max-width: 768px) {
            .border-end {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }

            .container-fluid {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        /* Card enhancements */
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        /* Button improvements */
        .btn-rounded-pill {
            border-radius: 50px;
        }

        /* Image styling */
        .img-thumbnail {
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .img-thumbnail:hover {
            border-color: #007bff;
            transform: scale(1.05);
        }
    </style>
@endsection

@push('scripts')
<script>
    // Auto-adjust layout height
    document.addEventListener('DOMContentLoaded', function() {
        function adjustLayout() {
            const navbar = document.querySelector('.navbar');
            const footer = document.querySelector('.footer');
            const container = document.querySelector('.container-fluid');

            if (navbar && footer && container) {
                const navbarHeight = navbar.offsetHeight;
                const footerHeight = footer.offsetHeight;
                const windowHeight = window.innerHeight;

                const minHeight = windowHeight - navbarHeight - footerHeight;
                container.style.minHeight = minHeight + 'px';
            }
        }

        // Adjust on load and resize
        adjustLayout();
        window.addEventListener('resize', adjustLayout);
    });
</script>
@endpush
