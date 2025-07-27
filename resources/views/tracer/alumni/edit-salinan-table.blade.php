@extends('layouts.admin')

@section('content')
    <div class="bg-body-light border-bottom py-4 mb-3">
        <div class="content d-flex flex-column flex-sm-row justify-content-between align-items-center">
            <div>
                <h1 class="h3 fw-bold text-primary mb-1">📄 Edit Data Tracer Alumni</h1>
                <p class="text-muted mb-0">Perbarui data tracer alumni.</p>
            </div>
            <div>
                <a href="{{ route('listtraceralumni.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded shadow">
            <div class="block-header block-header-default bg-primary text-white">
                <h3 class="block-title fw-semibold">📋 Form Edit Tracer Alumni</h3>
            </div>
            <div class="block-content block-content-full">
                <form action="{{ route('listtraceralumni.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Informasi Personal -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $data->alumni->nama_lengkap ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor HP/WA</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $data->alumni->no_hp ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $data->alumni->users->email ?? (auth()->user()->email ?? '')) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="form-control" value="{{ old('tahun_lulus', $data->alumni->tahun_lulus ?? '') }}" min="2000" max="2024" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $data->alumni->alamat ?? '') }}" required>
                            </div>
                        </div>
                        <!-- Status Pekerjaan -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status Pekerjaan</label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input type="radio" name="bekerja" value="ya" id="bekerja_ya"
                                            class="form-check-input"
                                            {{ old('bekerja', $data->bekerja) == 'ya' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="bekerja_ya">Bekerja</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="bekerja" value="wirausaha" id="bekerja_wirausaha"
                                            class="form-check-input"
                                            {{ old('bekerja', $data->bekerja) == 'wirausaha' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bekerja_wirausaha">Wirausaha</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="bekerja" value="tidak" id="bekerja_tidak"
                                            class="form-check-input"
                                            {{ old('bekerja', $data->bekerja) == 'tidak' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="bekerja_tidak">Tidak bekerja</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Wirausaha -->
                        <div class="col-12" id="detailWirausaha" style="display: {{ old('bekerja', $data->bekerja) == 'wirausaha' ? 'block' : 'none' }};">
                            <div class="alert alert-info mb-3 py-2">*Isi jika memilih status <b>Wirausaha</b></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Usaha</label>
                                    <input type="text" name="nama_usaha" class="form-control" value="{{ old('nama_usaha', $data->nama_usaha) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Posisi/Jabatan</label>
                                    <select name="posisi_usaha" class="form-select">
                                        <option value="" disabled>-- Pilih posisi --</option>
                                        <option value="founder" {{ old('posisi_usaha', $data->posisi_usaha) == 'founder' ? 'selected' : '' }}>Founder</option>
                                        <option value="co-founder" {{ old('posisi_usaha', $data->posisi_usaha) == 'co-founder' ? 'selected' : '' }}>Co-Founder</option>
                                        <option value="staff" {{ old('posisi_usaha', $data->posisi_usaha) == 'staff' ? 'selected' : '' }}>Staff</option>
                                        <option value="freelance" {{ old('posisi_usaha', $data->posisi_usaha) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tingkat Usaha</label>
                                    <select name="tingkat_usaha" class="form-select">
                                        <option value="" disabled>-- Pilih tingkat --</option>
                                        <option value="lokal" {{ old('tingkat_usaha', $data->tingkat_usaha) == 'lokal' ? 'selected' : '' }}>Lokal</option>
                                        <option value="nasional" {{ old('tingkat_usaha', $data->tingkat_usaha) == 'nasional' ? 'selected' : '' }}>Nasional</option>
                                        <option value="internasional" {{ old('tingkat_usaha', $data->tingkat_usaha) == 'internasional' ? 'selected' : '' }}>Internasional</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pendapatan Usaha</label>
                                    <select name="pendapatan_usaha" class="form-select">
                                        <option value="" disabled>-- Pilih pendapatan --</option>
                                        <option value="0-2000000" {{ old('pendapatan_usaha', $data->pendapatan_usaha) == '0-2000000' ? 'selected' : '' }}>0 - 2 juta</option>
                                        <option value="2000001-4000000" {{ old('pendapatan_usaha', $data->pendapatan_usaha) == '2000001-4000000' ? 'selected' : '' }}>&gt; 2 - 4 juta</option>
                                        <option value="4000001-999999999" {{ old('pendapatan_usaha', $data->pendapatan_usaha) == '4000001-999999999' ? 'selected' : '' }}>&gt; 4 juta</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat Usaha</label>
                                    <input type="text" name="alamat_usaha" class="form-control" value="{{ old('alamat_usaha', $data->alamat_usaha) }}">
                                </div>
                            </div>
                        </div>
                        <!-- Detail Pekerjaan -->
                        <div class="col-12" id="detailPekerjaan" style="display: {{ old('bekerja', $data->bekerja) == 'ya' ? 'block' : 'none' }};">
                            <div class="alert alert-info mb-3 py-2">*Isi jika memilih status <b>Bekerja</b></div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control" value="{{ old('nama_perusahaan', $data->nama_perusahaan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $data->jabatan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lokasi Pekerjaan</label>
                                    <input type="text" name="alamat_pekerjaan" class="form-control" value="{{ old('alamat_pekerjaan', $data->alamat_pekerjaan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gaji Pertama</label>
                                    <input type="text" name="gaji" class="form-control" value="{{ old('gaji', $data->gaji) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Kompetensi -->
                        <div class="col-12 mt-4">
                            <div class="block block-rounded border mb-3">
                                <div class="block-header bg-light fw-semibold">Survey Kompetensi Lulusan</div>
                                <div class="block-content">
                                    @php
                                        $opsi_kompetensi = [
                                            '' => '-- Pilih Level --',
                                            'sangat_baik' => 'Sangat Baik',
                                            'baik' => 'Baik',
                                            'cukup' => 'Cukup',
                                            'kurang_baik' => 'Kurang Baik',
                                            'tidak_baik' => 'Tidak Baik',
                                        ];
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Etika</label>
                                            <select name="etika" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('etika', $data->etika) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Keahlian</label>
                                            <select name="keahlian" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('keahlian', $data->keahlian) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Penggunaan Teknologi</label>
                                            <select name="penggunaanteknologi" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('penggunaanteknologi', $data->penggunaanteknologi) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Kerja Sama Tim</label>
                                            <select name="teamwork" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('teamwork', $data->teamwork) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Komunikasi</label>
                                            <select name="komunikasi" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('komunikasi', $data->komunikasi) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Pengembangan Skils</label>
                                            <select name="pengembangan" class="form-select" required>
                                                @foreach ($opsi_kompetensi as $val => $label)
                                                    <option value="{{ $val }}" {{ old('pengembangan', $data->pengembangan) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Evaluasi Pendidikan -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Evaluasi Pendidikan<br><span class="text-muted small">Apakah kurikulum kampus relevan dengan pekerjaan Anda sekarang?</span></label>
                                <select name="relevansi_kurikulum" class="form-select" required>
                                    <option value="" disabled>-- Pilih tingkat relevansi --</option>
                                    <option value="sangat_relevan" {{ old('relevansi_kurikulum', $data->relevansi_pekerjaan) == 'sangat_relevan' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Sangat Relevan</option>
                                    <option value="relevan" {{ old('relevansi_kurikulum', $data->relevansi_pekerjaan) == 'relevan' ? 'selected' : '' }}>⭐⭐⭐⭐ Relevan</option>
                                    <option value="cukup" {{ old('relevansi_kurikulum', $data->relevansi_pekerjaan) == 'cukup' ? 'selected' : '' }}>⭐⭐⭐ Cukup Relevan</option>
                                    <option value="tidak_relevan" {{ old('relevansi_kurikulum', $data->relevansi_pekerjaan) == 'tidak_relevan' ? 'selected' : '' }}>⭐⭐ Kurang Relevan</option>
                                    <option value="sangat_tidak_relevan" {{ old('relevansi_kurikulum', $data->relevansi_pekerjaan) == 'sangat_tidak_relevan' ? 'selected' : '' }}>⭐ Tidak Relevan</option>
                                </select>
                            </div>
                        </div>
                        <!-- Saran -->
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Saran & Komentar</label>
                                <textarea name="saran" class="form-control" rows="3">{{ old('saran', $data->saran) }}</textarea>
                            </div>
                        </div>
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

    <script>
        // Show/hide detail wirausaha & pekerjaan
        document.querySelectorAll('input[name="bekerja"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const detailPekerjaan = document.getElementById('detailPekerjaan');
                const detailWirausaha = document.getElementById('detailWirausaha');
                if (this.value === 'ya') {
                    detailPekerjaan.style.display = 'block';
                    detailWirausaha.style.display = 'none';
                } else if (this.value === 'wirausaha') {
                    detailPekerjaan.style.display = 'none';
                    detailWirausaha.style.display = 'block';
                } else {
                    detailPekerjaan.style.display = 'none';
                    detailWirausaha.style.display = 'none';
                }
            });
        });
    </script>
        <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/oneui.min.css') }}">
    <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>

@endsection
