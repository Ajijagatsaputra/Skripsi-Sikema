<!DOCTYPE html>
<html lang="id">
@include('components.admin.head')

<body>
    <div id="page-container"
        class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
        @include('components.admin.admin-header')
        @include('components.admin.sidebar')
        @include('components.admin.side-overlay')

        <main id="main-container">
            <!-- Header -->
            <div class="bg-body-light border-bottom py-4">
                <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 fw-bold text-primary mb-1">📄 Edit Data Tracer Pengguna Alumni</h1>
                        <p class="text-muted mb-0">Perbarui data tracer pengguna alumni.</p>
                    </div>
                    <div>
                        <a href="{{ route('listtracerpengguna.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="block block-rounded shadow">
                    <div class="block-header block-header-default bg-primary text-white">
                        <h3 class="block-title fw-semibold">📋 Form Edit Tracer Pengguna Alumni</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form action="{{ route('listtracerpengguna.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Informasi Personal -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ $data->nama }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Program Studi</label>
                                        <select name="prodi" class="form-control">
                                            <option value="teknik_informatika"
                                                {{ old('prodi', $data->prodi ?? '') == 'teknik_informatika' ? 'selected' : '' }}>
                                                Teknik Informatika
                                            </option>
                                            <option value="sistem_informasi"
                                                {{ old('prodi', $data->prodi ?? '') == 'sistem_informasi' ? 'selected' : '' }}>
                                                Sistem Informasi
                                            </option>
                                            <option value="manajemen"
                                                {{ old('prodi', $data->prodi ?? '') == 'manajemen' ? 'selected' : '' }}>
                                                Manajemen
                                            </option>
                                            <option value="akuntansi"
                                                {{ old('prodi', $data->prodi ?? '') == 'akuntansi' ? 'selected' : '' }}>
                                                Akuntansi
                                            </option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control"
                                            value="{{ $data->alamat }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control"
                                            value="{{ $data->jabatan }}">
                                    </div>
                                </div>

                                <!-- Survey Kompetensi Lulusan -->
                                <h5 class="fw-bold mt-4">📊 Survey Kompetensi Lulusan</h5>
                                @php
                                    $opsi_kompetensi = [
                                        'sangat_baik' => 'Sangat Baik',
                                        'baik' => 'Baik',
                                        'cukup' => 'Cukup',
                                        'kurang_baik' => 'Kurang Baik',
                                        'tidak_baik' => 'Tidak Baik',
                                    ];
                                @endphp

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Integritas</label>
                                            <select name="integritas" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->integritas === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keahlian</label>
                                            <select name="keahlian" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->keahlian === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kemampuan</label>
                                            <select name="kemampuan" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->kemampuan === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Penguasaan Bidang</label>
                                            <select name="penguasaan" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->penguasaan === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Komunikasi</label>
                                            <select name="komunikasi" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->komunikasi === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kerja Tim</label>
                                            <select name="kerja_tim" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->kerja_tim === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pengembangan Diri</label>
                                            <select name="pengembangan" class="form-select">
                                                @foreach ($opsi_kompetensi as $key => $label)
                                                    <option value="{{ $key }}"
                                                        {{ $data->pengembangan === $key ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Perusahaan -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Perusahaan</label>
                                        <input type="text" name="nama_perusahaan" class="form-control"
                                            value="{{ $data->nama_perusahaan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Perusahaan</label>
                                        <input type="text" name="alamat_perusahaan" class="form-control"
                                            value="{{ $data->alamat_perusahaan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Atasan</label>
                                        <input type="text" name="nama_atasan" class="form-control"
                                            value="{{ $data->nama_atasan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">NIP Atasan</label>
                                        <input type="text" name="nip_atasan" class="form-control"
                                            value="{{ $data->nip_atasan }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Posisi Jabatan Atasan</label>
                                        <input type="text" name="posisi_jabatan_atasan" class="form-control"
                                            value="{{ $data->posisi_jabatan_atasan }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Saran -->
                            <div class="mb-3">
                                <label class="form-label">Saran & Komentar</label>
                                <textarea name="saran" class="form-control">{{ $data->saran }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>

        @include('components.admin.footer')
    </div>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
    <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>

</body>

</html>
