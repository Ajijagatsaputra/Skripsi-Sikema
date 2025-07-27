@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card shadow-sm rounded">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">👤 Edit Profil Admin</h5>
                    </div>
                    <div class="card-body">
                        {{-- Flash Message --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('profileadmin.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Avatar -->
                                <div class="col-md-3 text-center border-end">
                                    @if ($admin->avatar)
                                        <img src="{{ asset('storage/' . $admin->avatar) }}"
                                            class="img-thumbnail rounded-circle mb-2" width="120" height="120"
                                            alt="Foto Admin">
                                    @else
                                        <img src="{{ asset('assets/media/avatars/avatar13.jpg') }}"
                                            class="img-thumbnail rounded-circle mb-2" width="120" height="120"
                                            alt="Foto Admin">
                                    @endif
                                    <div class="mb-3">
                                        <label for="avatar" class="form-label small">Ganti Foto</label>
                                        <input class="form-control form-control-sm @error('avatar') is-invalid @enderror"
                                            type="file" id="avatar" name="avatar">
                                        @error('avatar')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Data Profil -->
                                <div class="col-md-9">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" id="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ old('username', $admin->username) }}">
                                            @error('username')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $admin->name) }}">
                                            @error('name')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', $admin->email) }}">
                                        @error('email')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <button type="submit" class="btn btn-primary rounded-pill">
                                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                                        </button>

                                        <a href="{{ route('admin.dashboard') }}"
                                            class="btn btn-outline-secondary btn-sm rounded-pill">
                                            <i class="fas fa-arrow-left me-1"></i> Kembali
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="my-5">

                        <!-- Ganti Password -->
                        <h5 class="mb-3">🔒 Ganti Password</h5>
                        <form action="{{ route('profileadmin.update-password') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="current_password" class="form-label">Password Lama</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror">
                                    @error('current_password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="new_password" class="form-label">Password Baru</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror">
                                    @error('new_password')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control">
                            </div>

                            <button type="submit" class="btn btn-warning rounded-pill">
                                <i class="fas fa-key me-1"></i> Ubah Password
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .container-fluid {
            min-height: calc(100vh - 140px);
        }

        @media (max-width: 768px) {
            .border-end {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }
        }

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
